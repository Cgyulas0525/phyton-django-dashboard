<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ajanlatbetolt
 * @package App\Models
 * @version March 6, 2020, 10:16 am UTC
 *
 * @property string Kötvényszám
 * @property string Szerződő neve
 * @property string Szerződő címe
 * @property string Szerződő munkahelyi telefonszáma
 * @property string Szerződő mobil telefonszáma
 * @property string Szerződő email címe
 * @property string Biztosított 1 neve
 * @property string Biztosított 2 neve
 * @property string Termék neve
 * @property string Partner kódja
 * @property string Partner neve
 * @property string Értékesítési csatorna
 * @property string Partner típusa
 * @property string Díjfiz gyakoriság
 * @property string Gyakorisági díj
 * @property string Rider gyakorisági díj
 * @property string Szerződés státusza
 * @property string Törlés/Elutasítás dátuma
 * @property string Törlés hatálynapja
 * @property string Ajánlat beérk. dátuma
 * @property string Aláírás dátuma
 * @property string Kötvényesítés dátuma
 * @property string Állománydíj
 * @property string Rider állománydíj összesen
 * @property string Baleseti kieg. állománydíj
 * @property string Díjátvállalási kieg.állománydíj
 * @property string Best Doctors kieg. állománydíj
 * @property string Kötvényátvétel dátuma
 * @property string Díjfizetési tartam
 * @property string Díjfizetési mód
 * @property string Díjrendezett
 * @property string Pénznem
 * @property string Örökített?
 * @property string Díjszüneteltetett?
 * @property string Nyugdíjbiztosítás?
 * @property string Kötéskori partner neve
 */
class Ajanlatbetolt extends Model
{
    use SoftDeletes;

    public $table = 'ajanlatbetolt';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'Kötvényszám',
        'Szerződő_neve',
        'Szerződő_címe',
        'Szerződő_munkahelyi_telefonszáma',
        'Szerződő_mobil_telefonszáma',
        'Szerződő_email_címe',
        'Biztosított_1_neve',
        'Biztosított_2_neve',
        'Termék_neve',
        'Partner_kódja',
        'Partner_neve',
        'Értékesítési_csatorna',
        'Partner_típusa',
        'Díjfiz_gyakoriság',
        'Gyakorisági_díj',
        'Rider_gyakorisági_díj',
        'Szerződés_státusza',
        'Törlés/Elutasítás_dátuma',
        'Törlés_hatálynapja',
        'Ajánlat_beérk._dátuma',
        'Aláírás_dátuma',
        'Kötvényesítés_dátuma',
        'Állománydíj',
        'Rider_állománydíj_összesen',
        'Baleseti_kieg._állománydíj',
        'Díjátvállalási_kieg.állománydíj',
        'Best_Doctors_kieg._állománydíj',
        'Kötvényátvétel_dátuma',
        'Díjfizetési_tartam',
        'Díjfizetési_mód',
        'Díjrendezett',
        'Pénznem',
        'Örökített',
        'Díjszüneteltetett',
        'Nyugdíjbiztosítás',
        'Kötéskori_partner_neve'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'Kötvényszám' => 'string',
        'Szerződő neve' => 'string',
        'Szerződő címe' => 'string',
        'Szerződő munkahelyi telefonszáma' => 'string',
        'Szerződő mobil telefonszáma' => 'string',
        'Szerződő email címe' => 'string',
        'Biztosított 1 neve' => 'string',
        'Biztosított 2 neve' => 'string',
        'Termék neve' => 'string',
        'Partner kódja' => 'string',
        'Partner neve' => 'string',
        'Értékesítési csatorna' => 'string',
        'Partner típusa' => 'string',
        'Díjfiz gyakoriság' => 'string',
        'Gyakorisági díj' => 'string',
        'Rider gyakorisági díj' => 'string',
        'Szerződés státusza' => 'string',
        'Törlés/Elutasítás dátuma' => 'string',
        'Törlés hatálynapja' => 'string',
        'Ajánlat beérk. dátuma' => 'string',
        'Aláírás dátuma' => 'string',
        'Kötvényesítés dátuma' => 'string',
        'Állománydíj' => 'string',
        'Rider állománydíj összesen' => 'string',
        'Baleseti kieg. állománydíj' => 'string',
        'Díjátvállalási kieg.állománydíj' => 'string',
        'Best Doctors kieg. állománydíj' => 'string',
        'Kötvényátvétel dátuma' => 'string',
        'Díjfizetési tartam' => 'string',
        'Díjfizetési mód' => 'string',
        'Díjrendezett' => 'string',
        'Pénznem' => 'string',
        'Örökített?' => 'string',
        'Díjszüneteltetett?' => 'string',
        'Nyugdíjbiztosítás?' => 'string',
        'Kötéskori partner neve' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public static function exceldate($excelDate){
        $miliseconds = ($excelDate - (25567 + 2)) * 86400 * 1000;
        $seconds = $miliseconds / 1000;
        $date = date("Y-m-d", $seconds);
        return $date;
    }

}
