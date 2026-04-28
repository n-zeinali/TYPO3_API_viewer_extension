<?php
declare(strict_types=1);

namespace Nafise\ApiViewer\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Nafise\ApiViewer\Service\ApiService;

class ApiController extends ActionController
{
    public function __construct(
        private readonly ApiService $apiService,
    ) {}

    public function indexAction(): ResponseInterface
    {
        // Read the values the editor typed in the FlexForm
        $apiUrl    = trim((string)($this->settings['apiUrl'] ?? ''));
        $itemLimit = max(1, (int)($this->settings['itemLimit'] ?? 10));
        $heading   = (string)($this->settings['heading'] ?? '');

        $items = [];
        $error = '';

        // Check if editor set a URL
        if ($apiUrl === '') {
            $error = 'No API URL set. Please edit this 
                      content element and enter a URL.';
        } else {
            // Call the API using our service
            $data = $this->apiService->fetch($apiUrl);

            if (empty($data)) {
                $error = 'Could not load data from: ' . $apiUrl;
            } else {
                // Only take the number of items the editor wanted
                $items = array_slice($data, 0, $itemLimit);
            }
        }

        // Send data to the Fluid template
        $this->view->assignMultiple([
            'items'   => $items,
            'heading' => $heading,
            'apiUrl'  => $apiUrl,
            'error'   => $error,
        ]);

        return $this->htmlResponse();
    }
}