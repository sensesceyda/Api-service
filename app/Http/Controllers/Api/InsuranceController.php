<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    private $apiBaseUrl;
    private $apiToken;

    public function __construct()
    {
        $this->apiBaseUrl = config('services.tamamliyo.base_url');
        $this->apiToken = config('services.tamamliyo.api_token');
    }

    
    public function getProductCodes()
    {
        $productCodes = [
            [
                "aciklama" => "Yurt İçi Seyahatler İçin",
                "urun" => "yurtici-seyahat"
            ],
            [
                "aciklama" => "Yurt Dışı Seyahatler İçin (Avrupa ve Dünya)",
                "urun" => "yurtdisi-seyahat",
                "urunIds" => [
                    [
                        "urun_id" => 141,
                        "aciklama" => "Standart Yurtdışı Seyahat Sağlık"
                    ],
                    [
                        "urun_id" => 185,
                        "aciklama" => "Covid Dahil Yurtdışı Seyahat Sağlık"
                    ],
                    [
                        "urun_id" => 189,
                        "aciklama" => "Covid Dahil, Vize Reddi Dahil Yurtdışı Seyahat Sağlık"
                    ]
                ]
            ]
        ];

        return response()->json([
            'success' => true,
            'tanim' => 'Seyahat Ürün Bilgileri',
            'urunKodlari' => $productCodes
        ]);
    }

 
    public function getPrice(Request $request)
    {
    
        if ($request->isMethod('get')) {
            return response()->json([
                "success" => true,
                "data" => [
                    "urunBilgileri" => [
                        "urunId" => 141,
                        "fiyat" => "122.84 ₺",
                        "urunAdi" => "Yurt Dışı Seyahat Sağlık Sigortası",
                        "urunAdiMultiple" => [
                            "tr" => "Yurt Dışı Seyahat Sağlık Sigortası",
                            "en" => "International Travel Health Insurance",
                            "ar" => "تأمين السفر الصحي الدولي",
                            "ru" => "Страхование здоровья при зарубежных поездках",
                            "de" => "Internationale Reisekrankenversicherung"
                        ],
                        "urunTanimi" => "Seyahat Sağlık Sigortası",
                        "urunKategoriBaslik" => "Yurt Dışı Seyahat Sağlık Sigortası",
                        "urunKategoriAciklama" => "Yurt dışındaki seyahatlerinde yüksek maliyetli sağlık giderlerini karşılayarak seni tam koruma altına alırız."
                    ],
                    "sigortaSirketiBilgileri" => [
                        "sigortaSirketiId" => 16,
                        "kisaAdi" => "Quick Sigorta",
                        "tamAdi" => "Quick Sigorta",
                        "yayinci" => "İş bu sigorta, Tamamliyo Teknoloji A.Ş. üzerinden, Quick Sigorta tarafından sunulmaktadır.",
                        "yayinciMultiple" => [
                            "tr" => "İş bu sigorta, Tamamliyo Teknoloji A.Ş. üzerinden, Quick Sigorta tarafından sunulmaktadır.",
                            "en" => "This insurance is provided by Quick Sigorta through Tamamliyo Teknoloji A.Ş.",
                            "ar" => "يتم تقديم هذا التأمين من قبل Quick Sigorta عبر Tamamliyo Teknoloji A.Ş.",
                            "ru" => "Это страхование предоставляется Quick Sigorta через Tamamliyo Teknoloji A.Ş.",
                            "de" => "Diese Versicherung wird von Quick Sigorta über Tamamliyo Teknoloji A.Ş. angeboten."
                        ]
                    ]
                ]
            ]);
        }

  
        $request->validate([
            'sigortaliSayisi' => 'required|integer|min:1',
            'baslangicTarihi' => 'required|date',
            'bitisTarihi' => 'required|date',
            'urun' => 'required|string',
            'ulkeKodu' => 'required|integer',
            'urun_id' => 'nullable|integer'
        ]);

        return response()->json([
            "success" => true,
            "data" => [
                "urunBilgileri" => [
                    "urunId" => $request->urun_id ?? 141,
                    "fiyat" => "122.84 ₺",
                    "urunAdi" => "Yurt Dışı Seyahat Sağlık Sigortası",
                    "urunAdiMultiple" => [
                        "tr" => "Yurt Dışı Seyahat Sağlık Sigortası",
                        "en" => "International Travel Health Insurance",
                        "ar" => "تأمين السفر الصحي الدولي",
                        "ru" => "Страхование здоровья при зарубежных поездках",
                        "de" => "Internationale Reisekrankenversicherung"
                    ],
                    "urunTanimi" => "Seyahat Sağlık Sigortası",
                    "urunKategoriBaslik" => "Yurt Dışı Seyahat Sağlık Sigortası",
                    "urunKategoriAciklama" => "Yurt dışındaki seyahatlerinde yüksek maliyetli sağlık giderlerini karşılayarak seni tam koruma altına alırız."
                ],
                "sigortaSirketiBilgileri" => [
                    "sigortaSirketiId" => 16,
                    "kisaAdi" => "Quick Sigorta",
                    "tamAdi" => "Quick Sigorta",
                    "yayinci" => "İş bu sigorta, Tamamliyo Teknoloji A.Ş. üzerinden, Quick Sigorta tarafından sunulmaktadır.",
                    "yayinciMultiple" => [
                        "tr" => "İş bu sigorta, Tamamliyo Teknoloji A.Ş. üzerinden, Quick Sigorta tarafından sunulmaktadır.",
                        "en" => "This insurance is provided by Quick Sigorta through Tamamliyo Teknoloji A.Ş.",
                        "ar" => "يتم تقديم هذا التأمين من قبل Quick Sigorta عبر Tamamliyo Teknoloji A.Ş.",
                        "ru" => "Это страхование предоставляется Quick Sigorta через Tamamliyo Teknoloji A.Ş.",
                        "de" => "Diese Versicherung wird von Quick Sigorta über Tamamliyo Teknoloji A.Ş. angeboten."
                    ]
                ]
            ]
        ]);
    }
}
