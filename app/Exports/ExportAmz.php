<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAmz implements WithHeadings, FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $id;

    public function __construct($id)
    {
        $this->id = $id;

    }

    public function headings(): array
    {

        return [
            'MockID',
            'ImportType',
            'TemplateID',
            'Title',
            'Front_URL',
            'Tags',
            'SingleDesign',
            'Design',
            'size:S',
            'size:S#Design',
            'size:M  ',
            'size:M#Design',
            'size:L  ',
            'size:L#Design',
            'size:XL ',
            'size:XL#Design ',
            'size:2XL',
            'size:2XL#Design',
            'size:3XL',
            'size:3XL#Design',
            'size:4XL',
            'size:4XL#Design',
            'size:5XL',
            'size:5XL#Design',
            'color:Black',
            'color:Black#Design',
            'color:Dark Heather',
            'color:Dark Heather#Design',
            'color:Forest Green',
            'color:Forest Green#Design',
            'color:Light Pink',
            'color:Light Pink#Design',
            'color:Light Blue',
            'color:Light Blue#Design',
            'color:Maroon ',
            'color:Maroon#Design',
            'color:Navy',
            'color:Navy#Design',
            'color:Sport Grey  ',
            'color:Sport Grey#Design',
            'color:Sand',
            'color:Sand#Design',
            'color:White',
            'color:White#Design',
            'SKU',

        ];
    }
    public function collection()
    {

        $id = $this->id;

        if ($id != 0) {
            $dataCenters = DB::table('products')->where('id', $id)->first();

            $result[] = [
                '',
                'Personal',
                '',
                $dataCenters->title ?? null,
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
            ];
        } else {
            $result[] = [];
        }
        return collect($result);

    }
}
