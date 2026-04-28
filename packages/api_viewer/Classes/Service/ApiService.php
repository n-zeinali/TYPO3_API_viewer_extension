<?php
declare(strict_types=1);

namespace Nafise\ApiViewer\Service;

use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ApiService
{
    public function __construct(
        private readonly RequestFactory $requestFactory,
    ) {}

    /**
     * Fetch a URL and return decoded JSON as array
     */
    public function fetch(string $url): array
    {
        // If URL is empty return nothing
        if (empty($url)) {
            return [];
        }

        try {
            // Call the API
            $response = $this->requestFactory->request($url, 'GET', [
                'headers' => [
                    'Accept'     => 'application/json',
                    'User-Agent' => 'TYPO3 ApiViewer/1.0',
                ],
                'timeout' => 10,
            ]);

            // If not 200 OK something went wrong
            if ($response->getStatusCode() !== 200) {
                $this->log('Error status: ' . $response->getStatusCode());
                return [];
            }

            // Decode the JSON response
            $data = json_decode(
                (string)$response->getBody(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            // If API returns a single object wrap it in array
            return is_array($data) ? $data : [$data];

        } catch (\Throwable $e) {
            $this->log($e->getMessage());
            return [];
        }
    }

    /**
     * Write errors to TYPO3 log
     */
    private function log(string $message): void
    {
        GeneralUtility::makeInstance(LogManager::class)
            ->getLogger(__CLASS__)
            ->error($message);
    }
}