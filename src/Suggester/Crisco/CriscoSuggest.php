<?php
namespace ValueSuggest\Suggester\Crisco;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class CriscoSuggest implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve suggestions from the dictionnaire des synonymes.
     *
     * @see https://crisco2.unicaen.fr/des/synonymes/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        //https://crisco2.unicaen.fr/des/autocompletion.php?q=ing%C3%A9&limit=9&timestamp=1595748608780
        $params = ['q' => $query, 'limit' => 9];
        $response = $this->client
        ->setUri('https://crisco2.unicaen.fr/des/autocompletion.php')
        ->setParameterGet($params)
        ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the response separate by space.
        $suggestions = [];
        $results = explode(PHP_EOL, $response->getBody());
        foreach ($results as $result) {
            $suggestions[] = [
                'value' => $result,
                'data' => [
                    'uri' => sprintf('https://crisco2.unicaen.fr/des/synonymes/%s', $result),
                    'info' => sprintf('Synonyme: %s', $result),
                ],
            ];
        }

        return $suggestions;
    }
}
