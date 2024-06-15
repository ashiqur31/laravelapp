<?php

namespace App\Imports;

use App\Models\UploadFile;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param array $row
     *
     * @return UploadFile|null
     */
    public function model(array $row)
    {
        return null;
    }
}
