<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\History;

class HistoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function getOrder() {
        return 2;
    }
    
    public function load(ObjectManager $manager) {
        
        $historyList = array(

            1   => array(14,8,16,10,22,12,14,4,18,4,6,16,14,8,6),
            2   => array(12,4,8,10,20,14,12,4,4,10,10,12,18,12,10),
            3   => array(6,18,14,8,12,6,6,10,14,14,10,6,14,6,10),
            4   => array(12,8,2,12,8,12,10,2,10,16,6,14,14,6,14),
            5   => array(12,6,8,8,14,14,14,6,14,4,6,14,8,8,6),
            6   => array(8,8,10,10,12,8,12,6,12,10,8,14,10,6,8),
            7   => array(12,6,8,8,20,12,10,4,6,6,6,18,10,8,8),

            8   => array(10,16,24,6,12,12,10,2,10,16,14,12,18,12,16),
            9   => array(8,10,6,4,16,16,8,10,12,20,18,10,18,16,14),
            10  => array(10,20,12,8,14,14,8,10,8,12,16,18,18,6,12),
            11  => array(6,8,14,12,8,16,8,10,10,10,20,10,16,20,14),
            12  => array(8,16,6,6,14,10,8,8,16,20,12,12,18,14,12),
            13  => array(6,24,10,6,8,10,10,6,16,12,6,14,18,14,14),
            14  => array(8,16,6,8,16,10,6,6,10,16,10,20,16,16,10),
            15  => array(8,12,6,2,8,14,14,2,16,14,12,12,18,12,16),
            16  => array(6,18,10,8,6,16,2,2,12,16,12,12,14,8,16),
            17  => array(8,12,10,2,10,6,12,4,8,10,18,12,14,10,14),

            18  => array(18,18,14,20,10,14,12,16,10,12,10,10,8,14,18),
            19  => array(10,20,10,16,12,18,16,12,12,14,8,12,14,12,14),
            20  => array(14,18,16,16,6,10,16,10,8,16,4,16,18,10,14),
            21  => array(16,16,20,14,8,10,14,18,6,16,6,8,12,8,14),
            22  => array(10,22,14,18,8,14,18,10,10,4,8,18,10,10,12),
            23  => array(16,18,16,18,16,12,14,4,10,10,4,12,20,6,8),
            24  => array(14,16,22,8,8,12,8,14,16,12,4,14,12,6,14),
            25  => array(14,14,22,14,8,10,10,10,16,12,6,10,10,8,14),
            26  => array(14,16,14,18,6,16,20,6,8,12,8,8,6,6,14),
            27  => array(16,16,12,20,16,6,0,16,10,12,6,10,6,8,14),

            28  => array(16,12,6,8,10,6,8,22,14,16,26,12,6,14,16),
            29  => array(16,14,14,10,12,6,18,10,10,16,18,16,10,6,6),
            30  => array(10,14,16,12,10,12,10,14,10,16,18,18,8,4,10),
            31  => array(20,14,18,8,4,8,16,12,10,10,10,16,10,8,8),
            32  => array(8,18,8,8,12,4,14,10,8,10,18,18,4,6,14),
            33  => array(12,10,18,8,4,6,18,20,12,12,12,14,6,4,2),
            34  => array(12,8,6,10,6,4,16,14,10,14,12,18,6,10,6),
            35  => array(12,12,12,10,10,12,18,14,10,12,6,12,2,4,2),
            36  => array(4,8,16,6,18,8,12,20,2,10,14,10,6,8,4),
            37  => array(12,12,12,8,6,8,8,12,6,14,4,20,10,4,8),

            38  => array(18,20,16,18,10,18,10,20,16,14,12,8,20,12,12),
            39  => array(16,22,10,14,10,22,14,18,14,18,12,12,20,6,12),
            40  => array(16,16,10,18,10,20,8,22,14,10,10,10,18,10,12),
            41  => array(12,14,10,20,14,20,12,10,18,12,6,8,18,8,20),
            42  => array(8,16,16,16,6,20,10,22,14,10,12,8,18,8,16),
            43  => array(16,12,16,10,8,12,16,18,22,8,8,14,14,6,12),
            44  => array(8,20,12,6,10,16,12,20,16,8,8,12,18,12,14),
            45  => array(8,0,10,16,4,16,10,20,12,10,12,10,18,8,6),
            46  => array(8,14,12,14,12,16,18,16,16,16,0,10,0,6,0),
            47  => array(14,0,20,10,12,20,14,16,18,16,0,10,0,0,0),

            48  => array(14,6,10,14,12,18,8,18,16,14,18,8,12,10,6),
            49  => array(16,10,12,8,12,16,6,16,12,10,24,4,10,14,8),
            50  => array(10,10,12,12,18,18,8,10,8,16,10,8,18,6,12),
            51  => array(10,6,20,12,12,10,4,18,14,12,12,8,18,10,6),
            52  => array(12,10,10,12,8,14,10,22,10,12,12,6,20,6,8),
            53  => array(12,14,16,10,14,18,12,14,10,12,10,4,14,10,0),
            54  => array(8,8,10,8,12,10,4,8,10,16,20,6,22,10,8),
            55  => array(10,12,8,12,10,18,8,10,10,16,10,6,8,8,8),
            56  => array(12,8,8,12,14,16,6,20,8,10,8,8,14,0,6),

            57  => array(24,8,14,12,10,8,12,10,18,14,18,12,16,18,4),
            58  => array(16,8,18,12,14,4,14,12,18,12,14,14,22,10,4),
            59  => array(14,10,20,12,10,6,14,6,16,16,12,16,14,10,8),
            60  => array(18,2,8,16,10,6,14,10,22,14,20,10,12,14,6),
            61  => array(10,8,14,10,12,4,14,14,16,10,16,10,14,14,12),
            62  => array(16,0,14,16,10,2,18,12,16,10,10,12,16,14,10),
            63  => array(18,10,10,12,2,8,0,16,10,12,14,12,14,20,6),
            64  => array(8,8,20,8,14,2,8,0,18,10,18,8,18,16,8),
            65  => array(8,4,12,14,12,4,0,0,20,8,24,8,0,0,0),
            66  => array(12,6,18,8,2,8,0,0,12,0,0,0,0,0,0),

            67  => array(8,14,10,8,16,14,16,20,10,12,14,14,8,12,18),
            68  => array(4,16,4,8,12,16,16,14,12,18,18,6,16,12,12),
            69  => array(14,18,8,4,10,14,14,18,12,8,18,10,6,12,16),
            70  => array(12,14,8,6,10,12,20,16,12,14,16,6,12,12,10),
            71  => array(12,8,14,10,20,10,16,12,8,14,12,12,10,6,16),
            72  => array(6,18,10,6,14,16,12,14,8,20,12,12,8,6,12),
            73  => array(6,14,14,4,12,14,12,26,12,0,16,10,10,2,10),
            74  => array(14,16,4,14,10,8,8,14,12,8,14,16,8,4,8),
            75  => array(6,12,6,6,10,14,8,6,12,14,10,10,4,8,10),

            76  => array(16,6,8,14,10,12,10,18,26,8,14,14,6,10,10),
            77  => array(16,8,10,14,10,12,4,20,18,14,14,10,8,6,10),
            78  => array(16,6,12,12,6,14,8,12,16,18,10,18,8,14,4),
            79  => array(14,12,8,12,6,12,6,14,14,12,14,18,8,12,8),
            80  => array(10,0,10,14,6,10,16,10,16,8,14,12,12,14,14),
            81  => array(14,12,10,10,12,10,8,10,16,6,14,12,14,6,10),
            82  => array(12,8,10,12,8,10,12,10,12,16,10,12,14,6,10),
            83  => array(14,4,8,10,0,10,10,12,20,8,16,14,12,8,8),
            84  => array(16,0,8,12,2,12,16,8,20,16,16,10,2,8,6),
            85  => array(12,8,8,14,6,10,12,8,14,6,12,16,8,4,8),

            86  => array(10,20,18,10,18,8,12,10,12,10,18,16,22,14,6),
            87  => array(10,18,10,10,14,8,18,10,18,8,18,12,14,12,6),
            88  => array(16,12,18,8,8,14,18,12,8,6,16,10,16,12,8),
            89  => array(18,16,10,6,12,14,14,10,10,4,12,12,16,14,6),
            90  => array(18,12,12,10,16,10,6,16,8,8,16,10,12,10,10),
            91  => array(14,10,6,10,10,8,20,12,16,12,16,12,12,10,6),
            92  => array(14,6,14,14,12,8,6,12,8,4,20,14,20,8,10),
            93  => array(10,16,8,6,14,6,20,8,8,8,18,10,18,10,6),
            94  => array(14,8,10,12,14,12,10,12,12,4,20,10,14,4,8),
            95  => array(12,8,16,8,10,8,12,10,14,2,20,8,18,10,4),

            96  => array(16,14,16,4,14,14,12,16,14,16,16,26,12,10,6),
            97  => array(8,16,12,10,10,16,14,16,14,14,18,18,8,12,10),
            98  => array(12,6,16,14,14,20,12,16,8,12,14,26,10,6,6),
            99  => array(14,16,6,10,18,12,12,14,12,16,10,22,8,8,6),
            100 => array(14,14,6,8,14,12,18,16,10,12,14,22,10,8,6),
            101 => array(12,8,10,16,16,14,10,14,10,12,12,18,14,8,8),
            102 => array(10,10,20,6,10,8,16,10,18,12,8,16,20,8,2),
            103 => array(10,12,10,8,14,16,14,8,8,12,6,12,10,14,14),
            104 => array(12,12,8,18,8,10,16,14,0,20,10,22,12,0,6),
            105 => array(8,14,14,10,14,12,16,8,14,8,2,12,10,0,0),

            106 => array(20,8,12,12,10,26,12,20,22,8,12,8,10,18,14),
            107 => array(16,8,18,8,14,22,18,16,16,12,12,10,10,16,14),
            108 => array(18,12,14,10,18,18,18,18,14,12,12,4,10,18,12),
            109 => array(16,12,16,10,12,18,18,20,12,10,10,6,8,16,16),
            110 => array(14,10,18,10,14,18,20,14,14,14,8,8,8,16,12),
            111 => array(14,14,18,10,10,22,10,16,18,6,14,8,6,20,8),
            112 => array(16,14,18,14,16,20,12,12,16,4,4,10,6,14,8),
            113 => array(12,10,16,12,16,16,14,14,18,4,10,6,14,12,6),
            114 => array(16,10,14,10,8,18,18,10,12,6,0,10,8,10,14),
            115 => array(16,12,10,10,12,16,0,12,16,8,16,0,0,0,0),

            116 => array(10,18,10,18,10,8,24,14,14,18,10,12,12,12,10),
            117 => array(14,14,14,16,16,10,12,12,8,20,16,10,16,12,8),
            118 => array(12,14,12,16,14,12,18,14,10,12,14,8,12,18,6),
            119 => array(12,18,12,16,14,6,10,14,10,20,14,12,12,8,12),
            120 => array(8,16,10,12,6,12,12,16,10,16,22,10,14,14,12),
            121 => array(8,18,12,18,10,12,12,16,6,18,12,12,14,8,6),
            122 => array(12,12,18,12,10,10,18,10,8,14,6,12,14,14,10),
            123 => array(6,12,10,12,8,14,14,10,8,12,10,4,10,12,12),
            124 => array(8,8,0,0,0,0,0,0,0,0,0,0,0,0,0),

            125 => array(18,18,16,16,6,8,14,18,16,4,18,20,14,14,6),
            126 => array(18,22,16,18,12,10,16,12,18,2,14,14,6,14,10),
            127 => array(14,16,16,16,6,10,16,12,20,6,12,10,16,10,10),
            128 => array(14,16,20,12,14,12,16,10,12,4,16,14,6,14,8),
            129 => array(20,10,18,16,8,2,10,14,10,8,12,12,18,12,12),
            130 => array(16,24,12,10,12,6,12,8,18,6,12,10,12,14,8),
            131 => array(20,16,14,10,8,8,16,6,22,2,12,16,12,12,4),
            132 => array(16,18,10,12,12,8,4,14,12,4,14,18,6,16,8),
            133 => array(16,16,8,18,6,6,10,10,14,6,10,14,12,16,8),

            134 => array(20,14,8,10,8,12,12,10,20,20,12,16,20,10,12),
            135 => array(18,14,6,10,10,12,14,12,20,12,22,16,16,8,12),
            136 => array(20,10,12,8,8,12,10,12,12,16,16,18,20,12,14),
            137 => array(12,16,12,14,6,12,12,12,12,12,12,18,18,10,12),
            138 => array(14,14,10,4,10,10,16,10,14,16,18,18,18,6,10),
            139 => array(20,16,6,6,10,10,14,10,12,10,14,12,16,18,14),
            140 => array(12,16,8,8,6,12,20,12,12,14,14,16,16,8,8),
            141 => array(12,16,12,8,12,10,18,10,12,6,12,6,20,14,8),
            142 => array(10,22,6,10,8,12,12,10,8,12,14,20,16,4,10),
            143 => array(16,14,6,10,16,12,12,8,14,0,10,20,16,8,12),

            144 => array(12,12,8,10,12,16,12,16,18,12,14,12,0,14,8),
            145 => array(10,8,14,8,10,18,12,12,30,10,6,8,4,10,12),
            146 => array(10,8,14,10,12,12,12,14,18,16,14,8,2,14,8),
            147 => array(12,8,10,6,12,20,14,12,20,20,6,8,2,14,8),
            148 => array(16,10,10,12,10,14,14,18,16,12,6,8,4,14,6),
            149 => array(12,8,18,8,8,8,14,14,18,12,4,6,12,14,12),
            150 => array(8,8,8,10,10,12,14,12,22,12,6,12,12,14,6),
            151 => array(12,6,8,14,12,12,10,14,12,18,14,8,0,12,12),
            152 => array(12,4,16,10,8,12,12,12,20,16,12,8,4,10,6),
            153 => array(8,6,10,10,10,14,18,16,14,10,8,8,8,0,10),

            154 => array(14,8,14,16,14,16,16,14,14,12,18,12,8,8,14),
            155 => array(20,8,16,20,12,10,14,10,20,14,12,8,2,12,14),
            156 => array(16,16,8,12,16,8,16,2,14,10,24,10,8,18,6),
            157 => array(14,6,16,18,16,10,18,14,12,14,8,8,4,10,12),
            158 => array(16,12,10,16,14,8,14,8,10,14,22,16,4,8,6),
            159 => array(14,10,8,10,14,8,16,14,12,16,12,8,2,14,6),
            160 => array(10,10,12,14,8,4,8,14,14,10,16,14,2,14,10),
            161 => array(14,8,0,16,18,6,14,6,10,14,14,8,6,12,10),
            162 => array(12,8,14,12,16,12,12,8,10,8,8,0,6,10,4),
            163 => array(18,10,10,0,12,6,16,6,18,10,16,0,0,4,12),

            164 => array(14,20,12,10,6,6,10,10,16,20,12,10,8,18,16),
            165 => array(8,22,10,8,4,6,14,8,14,20,14,10,8,16,12),
            166 => array(12,22,8,8,6,4,10,12,20,14,12,2,6,22,14),
            167 => array(14,8,8,10,6,8,12,16,20,16,12,2,6,18,14),
            168 => array(14,10,8,6,8,10,10,12,16,14,8,6,16,16,14),
            169 => array(12,16,12,12,10,8,10,10,14,10,8,4,14,14,10),
            170 => array(10,4,8,8,6,10,16,8,14,16,8,8,8,18,8),
            171 => array(10,12,2,10,6,6,12,6,14,14,12,8,6,16,14),
            172 => array(10,8,6,4,8,6,10,14,18,16,10,2,8,6,12),
            173 => array(8,6,12,4,8,4,8,20,14,16,10,6,6,0,10),

            174 => array(8,8,12,18,10,8,10,18,6,20,8,8,20,8,14),
            175 => array(10,10,14,10,18,10,8,10,18,16,10,12,10,8,10),
            176 => array(10,8,16,10,24,4,12,12,16,18,2,8,8,8,8),
            177 => array(10,10,6,6,18,12,8,10,8,16,6,12,14,4,16),
            178 => array(10,6,12,10,16,8,12,6,20,6,10,6,10,12,10),
            179 => array(6,6,12,6,18,10,10,10,8,14,10,14,10,6,14),
            180 => array(10,8,8,12,6,16,8,8,14,16,6,8,6,12,14),
            181 => array(8,12,8,4,12,16,10,10,8,20,8,10,12,4,4),
            182 => array(8,8,10,8,18,8,8,10,10,16,4,6,10,6,16),
            183 => array(6,4,4,6,8,12,6,6,10,14,12,12,20,12,12),
            184 => array(14,10,8,12,16,6,8,12,8,12,8,8,10,4,8),
            185 => array(8,8,8,8,12,12,8,10,8,10,12,10,6,6,8),

            186 => array(10,12,14,16,14,10,8,14,18,14,16,12,6,12,16),
            187 => array(12,8,18,20,12,16,4,14,4,6,16,14,6,16,10),
            188 => array(10,10,16,14,14,16,10,8,6,12,14,10,0,12,16),
            189 => array(6,12,16,16,12,14,6,10,16,8,8,8,4,16,14),
            190 => array(14,8,8,16,12,14,12,10,10,2,14,12,4,12,14),
            191 => array(14,6,14,20,12,14,6,8,14,6,10,8,8,14,8),
            192 => array(10,14,8,18,12,16,6,6,8,6,18,6,6,8,12),
            193 => array(8,10,12,8,12,6,8,8,10,6,16,10,6,10,8),
            194 => array(16,10,8,0,12,8,10,4,8,14,8,10,10,0,10),
            195 => array(10,6,10,12,8,18,10,4,6,14,14,10,2,0,4),

            196 => array(16,10,10,8,10,10,10,8,12,10,16,12,18,6,20),
            197 => array(12,6,6,6,8,10,12,16,14,16,12,10,16,12,16),
            198 => array(12,4,4,10,8,10,14,10,8,10,16,10,18,8,20),
            199 => array(12,6,2,10,4,12,10,14,8,14,10,8,18,12,12),
            200 => array(10,6,8,12,8,4,8,10,10,6,20,12,16,6,16),
            201 => array(14,12,6,2,6,12,8,12,10,12,10,8,12,6,20),
            202 => array(18,6,10,14,6,4,12,10,12,10,12,8,6,6,14),
            203 => array(12,2,6,14,8,10,6,8,12,12,10,10,16,4,16),
            204 => array(16,10,6,12,4,8,8,10,8,6,16,4,14,6,18),
            205 => array(8,6,6,10,10,8,4,14,18,6,12,10,14,8,8),
            206 => array(14,8,4,8,6,6,6,18,6,14,12,12,18,6,0),
            207 => array(12,0,6,10,2,10,8,6,12,16,14,10,12,0,16),
            208 => array(16,8,8,4,4,12,12,12,12,8,8,6,10,2,4),
            209 => array(10,6,10,4,10,8,6,8,10,6,8,8,6,8,12),

            210 => array(10,10,14,10,12,14,12,8,8,12,18,16,8,4,18),
            211 => array(12,8,10,10,16,4,16,8,10,12,12,16,16,10,10),
            212 => array(18,12,20,6,10,6,16,14,10,6,10,12,16,8,6),
            213 => array(8,16,8,14,20,6,8,14,4,8,20,16,12,6,6),
            214 => array(12,6,8,12,12,4,20,12,10,8,18,16,6,6,12),
            215 => array(14,10,12,14,18,4,10,10,8,8,18,10,14,4,8),
            216 => array(14,8,16,8,12,4,14,16,14,6,18,14,8,4,4),
            217 => array(10,10,10,16,16,12,8,8,6,8,14,12,16,4,10),
            218 => array(8,8,8,14,10,0,20,8,10,6,14,14,14,8,16),
            219 => array(16,14,12,8,12,4,6,14,6,4,16,12,10,10,14),
            220 => array(6,10,14,10,12,6,10,12,6,12,16,12,18,4,8),
            221 => array(10,10,10,12,6,6,10,12,10,4,24,14,10,8,6),
            222 => array(6,16,8,6,12,2,10,14,8,4,22,10,18,8,8),
            223 => array(18,12,4,8,8,4,16,12,12,4,14,10,8,10,10),
            224 => array(8,8,16,18,12,6,20,8,8,10,4,8,6,6,8),
            225 => array(10,6,12,10,12,6,10,12,8,14,12,12,8,6,4),
            226 => array(8,10,10,12,6,6,10,10,10,8,8,14,10,4,14),
            227 => array(12,6,8,12,12,12,16,8,8,4,0,4,14,4,10),
            
            228 => array(16,12,12,6,14,20,14,20,16,16,8,16,10,14,10),
            229 => array(14,12,10,8,16,18,16,14,14,8,6,14,16,18,16),
            230 => array(14,22,12,16,12,16,14,6,12,10,6,12,14,18,10),
            231 => array(18,10,10,8,18,14,14,12,14,16,4,12,12,14,10),
            232 => array(14,18,10,10,12,16,8,12,14,12,8,16,8,16,10),
            233 => array(20,10,14,8,18,14,6,18,14,8,12,8,8,10,12),
            234 => array(14,14,10,12,14,16,18,12,14,6,6,12,12,10,8),
            235 => array(16,18,8,16,14,12,8,12,16,10,4,12,12,0,12),
            236 => array(14,26,10,6,14,16,10,8,12,2,4,14,12,16,6),
            237 => array(12,10,12,2,6,16,16,16,12,10,4,16,12,14,10),
            238 => array(14,16,16,8,14,14,6,14,10,6,12,8,12,8,8),
            239 => array(14,20,8,16,6,14,8,8,10,6,8,16,6,18,8),
            240 => array(14,10,8,6,12,14,8,8,12,16,6,6,20,12,6),
            241 => array(8,18,18,6,16,10,6,6,12,4,4,16,4,16,14),
            242 => array(16,20,6,6,8,16,16,8,16,8,4,8,10,10,6),
            243 => array(12,18,12,6,10,14,8,10,10,8,8,8,10,14,8),
            244 => array(6,24,8,12,8,10,10,4,16,18,2,6,10,12,10),
            
            245 => array(22,10,12,10,16,12,12,6,22,10,12,12,18,10,10),
            246 => array(6,16,12,18,10,6,12,4,20,10,12,10,16,16,26),
            247 => array(18,14,22,14,10,4,12,12,14,6,8,18,10,10,14),
            248 => array(8,10,14,18,14,4,12,6,6,8,16,10,14,16,24),
            249 => array(10,16,14,14,14,14,10,2,18,6,10,16,6,16,12),
            250 => array(8,14,12,12,12,10,14,12,16,0,8,16,10,14,8),
            251 => array(12,8,12,16,10,8,8,10,12,8,12,14,18,6,8),
            252 => array(0,16,14,16,12,4,16,4,12,8,14,8,10,12,16),
            253 => array(8,12,10,16,16,4,10,10,12,2,8,6,12,12,22),
            254 => array(14,22,16,6,6,6,10,2,18,12,8,4,8,12,14),
            255 => array(10,8,16,6,8,12,8,6,14,10,10,8,14,8,10),
            256 => array(8,6,12,12,6,8,10,8,8,6,14,6,8,12,18),
            257 => array(10,12,14,10,10,10,12,2,10,8,10,14,2,10,0),
            258 => array(8,4,12,16,6,4,8,10,8,6,12,12,6,8,8),
            259 => array(8,8,12,10,0,10,8,4,10,6,6,10,4,10,16),
            260 => array(12,8,6,12,0,4,10,8,8,6,14,4,10,14,0),
			
            261 => array(16,10,10,14,16,18,14,10,14,12,20,10,8,10,18),
            262 => array(16,10,12,10,16,18,16,20,14,4,20,12,6,14,10),
            263 => array(10,14,12,12,14,16,8,14,16,8,12,12,10,16,22),
            264 => array(18,14,12,6,8,16,14,12,16,4,12,6,12,14,22),
            265 => array(14,16,8,14,12,12,10,16,18,6,10,16,6,18,8),
            266 => array(16,12,8,10,10,16,8,16,12,8,18,14,4,12,18),
            267 => array(10,12,8,12,12,20,8,16,12,12,20,14,2,6,18),
            268 => array(14,18,10,10,10,18,8,10,12,4,12,8,2,8,24),
            269 => array(14,14,6,12,16,12,8,12,14,6,14,6,0,16,14),
            270 => array(6,16,10,10,8,12,12,8,20,12,8,16,2,12,12),
            271 => array(16,4,8,8,8,16,10,12,14,8,16,8,4,12,18),
            272 => array(8,10,12,12,12,16,0,8,10,6,14,8,14,14,14),
            273 => array(10,10,10,2,10,12,6,10,18,8,8,8,6,14,18),
            274 => array(10,12,10,12,12,8,12,12,8,2,10,10,10,12,10),
            275 => array(12,10,6,10,14,10,16,10,10,6,10,12,4,8,10),
            276 => array(8,16,12,8,6,10,4,10,16,6,8,10,6,14,12),
            277 => array(14,10,6,14,16,14,0,10,10,4,10,14,10,14,0),
            
            278 => array(6,18,8,18,10,10,6,20,14,14,6,12,6,12,16),
            279 => array(18,10,10,18,8,4,12,16,14,12,14,10,12,10,8),
            280 => array(12,4,10,18,8,10,14,20,10,16,12,12,14,4,8),
            281 => array(10,8,4,8,14,10,16,22,10,14,10,8,18,6,2),
            282 => array(14,10,6,12,10,8,12,4,14,12,12,14,12,6,6),
            283 => array(8,10,6,14,16,10,8,10,16,6,10,8,10,6,10),
            284 => array(6,4,14,10,10,8,14,8,12,14,12,8,12,6,10),
            285 => array(10,6,8,10,16,10,14,12,12,18,4,10,6,0,10),
            286 => array(4,0,10,16,14,6,10,12,14,10,8,6,12,10,12),
            287 => array(4,8,12,14,16,4,12,8,12,8,14,10,10,0,12),
            288 => array(6,6,8,8,14,10,14,16,8,2,6,8,10,10,12),
            289 => array(4,6,10,10,16,8,4,12,12,12,8,6,6,14,8),
            290 => array(10,12,4,12,12,8,6,12,6,12,10,4,16,6,4),
            291 => array(4,6,10,10,10,12,14,12,12,6,14,4,10,4,6),
            292 => array(8,10,4,10,14,8,6,8,12,10,12,8,0,12,10),
            293 => array(6,8,8,6,10,16,14,10,10,8,8,0,6,10,8),
            294 => array(6,4,10,6,8,8,12,12,12,8,6,8,8,4,2),
            295 => array(4,6,10,10,10,12,12,10,6,8,6,6,0,0,0),
            296 => array(6,6,6,14,8,8,10,0,6,0,0,0,0,0,0),
            
            297 => array(14,14,12,14,18,14,2,8,12,10,14,10,8,12,12),
            298 => array(16,10,12,8,14,18,6,16,10,12,10,8,12,6,14),
            299 => array(16,8,20,8,6,20,10,12,8,14,8,12,8,8,12),
            300 => array(16,8,16,4,14,18,12,10,6,18,14,6,8,6,12),
            301 => array(12,16,6,16,14,14,6,10,8,12,12,6,6,12,14),
            302 => array(12,8,16,10,6,20,8,8,10,12,18,4,6,14,12),
            303 => array(14,14,8,12,10,20,4,4,10,14,16,4,12,12,8),
            304 => array(12,12,8,8,14,20,6,12,12,16,12,0,12,10,8),
            305 => array(18,8,16,14,12,18,4,12,4,12,10,8,6,10,10),
            306 => array(16,12,12,12,8,20,8,4,6,8,12,6,18,4,12),
            307 => array(14,4,16,6,8,22,8,12,8,10,14,6,10,10,10),
            308 => array(16,4,6,10,14,20,8,6,8,12,16,8,10,6,12),
            309 => array(12,8,6,16,10,18,6,10,12,6,10,14,10,8,8),
            310 => array(16,6,16,8,12,16,10,8,8,12,10,4,4,10,12),
            311 => array(12,10,6,8,12,20,4,8,6,14,12,6,12,6,16),
            312 => array(14,4,16,8,6,16,6,4,8,10,8,10,12,8,10),
            313 => array(16,8,10,2,8,20,8,10,12,8,10,6,0,6,10),
            314 => array(14,6,16,6,8,8,8,4,10,12,10,4,6,10,8),
            315 => array(16,6,10,6,16,16,6,8,12,0,0,0,0,0,0)
            
        );
        
        foreach ($historyList as $statistic => $points) {
            foreach ($points as $matchday => $points) {

                $history = new History();
                $history->setMatchday($this->getReference('matchday-Kolejka '.($matchday+1)));
                $history->setStatistic($this->getReference('statistic-'.$statistic));
                $history->setNumOfPoints($points);

                $manager->persist($history);
            }
        }
        
        $manager->flush();
    }
}
