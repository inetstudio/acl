<?php

namespace InetStudio\ACL\Users\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use InetStudio\ACL\Users\Contracts\Exports\UsersExportContract;

/**
 * Class UsersExport.
 */
class UsersExport implements UsersExportContract, FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    /**
     * @var
     */
    protected $usersRepository;

    /**
     * UsersExport constructor.
     */
    public function __construct()
    {
        $this->usersRepository = app()->make('InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->usersRepository->getItemsQuery(['created_at'], ['profile']);
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
