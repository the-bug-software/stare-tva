<?php

namespace TheBugSoftware\StareTva\Traits;

/**
 * FormatResponse trait.
 */
trait FormatResponse
{
    /**
     * Format the API response.
     *
     * @param array $items
     *
     * @return object
     */
    public function response($items)
    {
        $results = [];
        foreach ($items['found'] as $item) {
            $results[] = [
                'cui'            => $item['cui'],
                'name'           => $item['denumire'],
                'address'        => $item['adresa'],
                'status'         => [
                    'deactivation_date' => $item['dataInactivare'],
                    'reactivation_date' => $item['dataReactivare'],
                    'publish_date'      => $item['dataPublicare'],
                    'erasure_date'      => $item['dataRadiere'],
                ],
                'vat'            => [
                    'active'     => $item['scpTVA'],
                    'message'    => $item['mesaj_ScpTVA'],
                    'start_date' => $item['data_inceput_ScpTVA'],
                    'end_date'   => $item['data_sfarsit_ScpTVA'],
                    'tax_date'   => $item['data_anul_imp_ScpTVA'],
                ],
                'vat_on_receipt' => [
                    'active'       => $item['statusTvaIncasare'],
                    'message'      => $item['tipActTvaInc'],
                    'start_date'   => $item['dataInceputTvaInc'],
                    'end_date'     => $item['dataSfarsitTvaInc'],
                    'published_at' => $item['dataPublicareTvaInc'],
                    'updated_at'   => $item['dataActualizareTvaInc'],
                ],
                'vat_split'      => [
                    'active'     => $item['statusSplitTVA'],
                    'start_date' => $item['dataInceputSplitTVA'],
                    'end_date'   => $item['dataAnulareSplitTVA'],
                ],
                'vat_stats_at'   => $item['data'],
            ];
        }

        return json_encode([
            'success' => true,
            'items'   => $results,
        ]);
    }
}
