<?php
namespace ValueSuggest\Suggester\Ieml;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class IemlSuggest implements SuggesterInterface
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
     * Retrieve suggestions from the dictionnaire IEML.
     *
     * @see https://intlekt.io/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $json = file_get_contents(sprintf('%s/ieml.json', __DIR__));
        $results = json_decode($json, true);

        foreach ($results as $r) {
            //TODO:gérer les langues
            foreach ($r['fr'] as $text) {
                if (stristr($text, $query)) {
                    $info = [];
                    $info[] = sprintf('class: %s', $r['class']);
                    $info[] = sprintf('ieml: %s', $r['ieml']);
                    $suggestions[] = [
                        'value' => $text,
                        'data' => [
                            'uri' => sprintf('https://intlekt.io/?comments=%s', $r['ieml']),
                            'info' => implode("\n", $info),
                        ],
                    ];
                }
            }
        }
        usort($suggestions, function ($a, $b) {
            return strcmp($a['value'], $b['value']);
        });
        return $suggestions;
    }
}
