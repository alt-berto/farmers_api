<?php

use App\RedeemableProduct;
use Illuminate\Database\Seeder;

class RedeemableProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (RedeemableProduct::count() == 0) {
            RedeemableProduct::create([ #1
                'sku' => '6681023',
                'value' => 8,
                'name' => 'BARRERA 10 EC 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #2
                'sku' => '6681024',
                'value' => 8,
                'name' => 'BARRERA 10 EC 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #3
                'sku' => '6681022',
                'value' => 8,
                'name' => 'BARRERA 10 EC 20 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #4
                'sku' => '6681663',
                'value' => 5,
                'name' => 'BIOINDICADOR 60 SL 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #5
                'sku' => '6681685',
                'value' => 10,
                'name' => 'BIOVIT 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #6
                'sku' => '6681686',
                'value' => 10,
                'name' => 'BIOVIT 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #7
                'sku' => '6681099',
                'value' => 10,
                'name' => 'BORO BIONUTRIENTE 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #8
                'sku' => '6681100',
                'value' => 5,
                'name' => 'BORO BIONUTRIENTE 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #9
                'sku' => '6681122',
                'value' => 10,
                'name' => 'CALCIO BIONUTRIENTE 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #10
                'sku' => '6681123',
                'value' => 5,
                'name' => 'CALCIO BIONUTRIENTE 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #11
                'sku' => '6681124',
                'value' => 10,
                'name' => 'CALCIO BIONUTRIENTE 20 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #12
                'sku' => '6125378',
                'value' => 10,
                'name' => 'COMBO PRONUTIVA 1 CR',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #13
                'sku' => '6681154',
                'value' => 10,
                'name' => 'CROP BIONUTRIENTE 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #14
                'sku' => '6681155',
                'value' => 5,
                'name' => 'CROP BIONUTRIENTE 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #15
                'sku' => '6681161',
                'value' => 8,
                'name' => 'CYPROSOL 10 SL 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #16
                'sku' => '6681162',
                'value' => 8,
                'name' => 'CYPROSOL 10 SL 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #17
                'sku' => '6681701',
                'value' => 8,
                'name' => 'CYPROSOL 10 SL 20 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #18
                'sku' => '6681164',
                'value' => 8,
                'name' => 'CYPROSOL 10 SL 3.785 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #19
                'sku' => '6681718',
                'value' => 10,
                'name' => 'FOSNUTREN 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #20
                'sku' => '6681719',
                'value' => 10,
                'name' => 'FOSNUTREN 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #21
                'sku' => '6681720',
                'value' => 10,
                'name' => 'FOSNUTREN 25 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #22
                'sku' => '6681732',
                'value' => 10,
                'name' => 'KADOSTIM 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #23
                'sku' => '6681733',
                'value' => 10,
                'name' => 'KADOSTIM 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #24
                'sku' => '6681734',
                'value' => 10,
                'name' => 'KADOSTIM 25 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #25
                'sku' => '6681222',
                'value' => 10,
                'name' => 'MAGNESIO BIONUTRIENTE 20 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #26
                'sku' => '6681238',
                'value' => 8,
                'name' => 'MISTRAL 25 SC 0.2 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #27
                'sku' => '6681740',
                'value' => 8,
                'name' => 'MISTRAL 25 SC 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #28
                'sku' => '6681741',
                'value' => 8,
                'name' => 'MISTRAL 25 SC 20 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #29
                'sku' => '6681743',
                'value' => 8,
                'name' => 'MISTRAL 25 SC 3.785 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #30
                'sku' => '6681248',
                'value' => 10,
                'name' => 'NPK BIONUTRIENTE 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #31
                'sku' => '6681249',
                'value' => 5,
                'name' => 'NPK BIONUTRIENTE 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #32
                'sku' => '6681255',
                'value' => 6,
                'name' => 'OXATE 24 SL 0.5 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #33
                'sku' => '6681744',
                'value' => 6,
                'name' => 'OXATE 24 SL 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #34
                'sku' => '6681745',
                'value' => 6,
                'name' => 'OXATE 24 SL 20 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #35
                'sku' => '6681747',
                'value' => 6,
                'name' => 'OXIFLU 24 EC 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #36
                'sku' => '6681748',
                'value' => 6,
                'name' => 'OXIFLU 24 EC 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #37
                'sku' => '6681749',
                'value' => 6,
                'name' => 'OXIFLU 24 EC 20 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #38
                'sku' => '6681751',
                'value' => 6,
                'name' => 'OXIFLU 24 EC 3.5 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #39
                'sku' => '6681752',
                'value' => 5,
                'name' => 'PEGUNO 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #40
                'sku' => '6681753',
                'value' => 5,
                'name' => 'PEGUNO 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #41
                'sku' => '6681755',
                'value' => 5,
                'name' => 'PICLOR 30.4 SL 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #42
                'sku' => '6681261',
                'value' => 5,
                'name' => 'PICLOR 30.4 SL 18 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #43
                'sku' => '6681756',
                'value' => 5,
                'name' => 'PICLOR 30.4 SL 20 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #44
                'sku' => '6681262',
                'value' => 5,
                'name' => 'PICLOR 30.4 SL 200 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #45
                'sku' => '6681263',
                'value' => 5,
                'name' => 'PICLOR 30.4 SL 3.5 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #46
                'sku' => '6031989',
                'value' => 5,
                'name' => 'POLIQUEL BORO 12 CR',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #47
                'sku' => '6120576',
                'value' => 5,
                'name' => 'POLIQUEL CALCIO (12X1)_CR',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #48
                'sku' => '6120579',
                'value' => 5,
                'name' => 'POLIQUEL MULTI (12X1)_CR',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #49
                'sku' => '6681270',
                'value' => 5,
                'name' => 'POTASIO BIONUTRIENTE 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #50
                'sku' => '6681271',
                'value' => 10,
                'name' => 'POTASIO BIONUTRIENTE 20 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #51
                'sku' => '6681758',
                'value' => 6,
                'name' => 'PROPICOL 70 WP 0.75 KG',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #52
                'sku' => '6681277',
                'value' => 6,
                'name' => 'PROPICOL 70 WP 25 KG',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #53
                'sku' => '6681839',
                'value' => 6,
                'name' => 'PROPICOL 70 WP 25 KG FQ CR',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #54
                'sku' => '6681278',
                'value' => 6,
                'name' => 'PROPICON 25 EC 0.25 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #55
                'sku' => '6681759',
                'value' => 6,
                'name' => 'PROPICON 25 EC 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #56
                'sku' => '6681760',
                'value' => 6,
                'name' => 'PROPICON 25 EC 20 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #57
                'sku' => '6681771',
                'value' => 8,
                'name' => 'TERMINAL 15 SL 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #58
                'sku' => '6681772',
                'value' => 8,
                'name' => 'TERMINAL 15 SL 20 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #59
                'sku' => '6681773',
                'value' => 8,
                'name' => 'TERMINAL 15 SL 3.5 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #60
                'sku' => '6681836',
                'value' => 6,
                'name' => 'UNILAX 72 WP 1 KG BQ CR',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #61
                'sku' => '6120130',
                'value' => 6,
                'name' => 'UNILAX 72 WP 1 KG',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #62
                'sku' => '6120011',
                'value' => 6,
                'name' => 'VONDOCARB 52.5 SC 19 LTS',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #63
                'sku' => '6120123',
                'value' => 6,
                'name' => 'VONDOCARB 52.5 SC 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            RedeemableProduct::create([ #64
                'sku' => '6681327',
                'value' => 5,
                'name' => 'ZINC BIONUTRIENTE 1 LT',
                'description' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
        }
    }
}
