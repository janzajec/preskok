<?php

namespace App\Preskok\Junior;

class ForensicComputerScientist
{

    private $suspects = [
        [
            'name' => 'John Novak',
            'hair' => 'Black',
            'eyes' => 'Green',
            'race' => 'Asian',
        ],
        [
            'name' => 'Vin Diesel',
            'hair' => 'Blonde',
            'eyes' => 'Brown',
            'race' => 'Caucasian',
        ],
        [
            'name' => 'Guy Fawkes',
            'hair' => 'Black',
            'eyes' => 'Brown',
            'race' => 'Hispanic',
        ],
    ];

    private $legend = [
        'eyes' => [
            'Black' => '140L98',
            'Green' => '140A98',
            'Brown' => '140A88',
            'Blue' => '140L97',
        ],
        'hair' => [
            'Brown' => 'HHHKLJ',
            'Black' => 'HHHKLI',
            'Blonde' => 'HHLH1L',
            'White' => 'HHLH2L',
        ],
        'race' => [
            'Asian' => '1HYYYN',
            'Hispanic' => 'IHYYYN',
            'White' => 'IHYYNN'
        ],
    ];

    private $dnk = 'HHHKLJ140L98IHYYYN';

    public function find()
    {
        $result = [];

        foreach ($this->legend['eyes'] as $color => $code) {
            if (strpos($this->dnk, $code) !== false) {
                $result['eyes'] = $color;
            }
        }

        foreach ($this->legend['hair'] as $color => $code) {
            if (strpos($this->dnk, $code) !== false) {
                $result['hair'] = $color;
            }
        }

        foreach ($this->legend['race'] as $color => $code) {
            if (strpos($this->dnk, $code) !== false) {
                $result['race'] = $color;
            }
        }

        $person = 'Not listed';

        foreach ($this->suspects as $suspect) {
            if ($suspect['eyes'] != $result['eyes']) {
                continue;
            }

            if ($suspect['hair'] != $result['hair']) {
                continue;
            }

            if ($suspect['race'] != $result['race']) {
                continue;
            }

            $person = $suspect['name'];

        }

        echo "Murdered is: " . $person . "\n";
    }
}