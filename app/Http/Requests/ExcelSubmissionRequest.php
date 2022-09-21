<?php

namespace App\Http\Requests;

class ExcelSubmissionRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'submission_id' => 'required',
            'excel_file' => 'required|mimetypes:text/csv,text/plain,application/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|file|max:5120'
        ];
    }

    /**
     * Validation custom Messages.
     *
     * @return array
     */

    public function messages()
    {
        return [
            'excel_file.required' => 'File tidak boleh kosong',
            'excel_file.file' => 'File harus valid',
            'excel_file.max' => 'File maksimal 5 Mb',
            'excel_file.mimetypes' => 'Format file tidak sesuai'
        ];
    }
}
