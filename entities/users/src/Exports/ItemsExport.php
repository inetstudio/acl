<?php

namespace InetStudio\ACL\Users\Exports;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Users\Contracts\Exports\ItemsExportContract;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

/**
 * Class ItemsExport.
 */
class ItemsExport implements ItemsExportContract, FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    /**
     * @var string
     */
    protected $data = [];

    /**
     * Data property setter.
     *
     * @param  array  $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return Builder
     *
     * @throws BindingResolutionException
     */
    public function query()
    {
        $usersService = app()->make('InetStudio\ACL\Users\Contracts\Services\Back\ItemsServiceContract');

        return $usersService->getModel()->buildQuery(
            [
                'columns' => ['created_at'],
                'relations' => ['profile'],
            ]
        );
    }

    /**
     * @param $user
     *
     * @return array
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            Date::dateTimeToExcel($user->created_at),
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Имя',
            'Email',
            'Дата регистрации',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
