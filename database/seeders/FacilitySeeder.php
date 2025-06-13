<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
{
    // Set memory limit and max execution time for large files
    ini_set('memory_limit', '256M');
    ini_set('max_execution_time', '600');

    // Path to the CSV file
    $csvFile = base_path('database/seeders/ref/ref_facility.csv');

    // Check if the file exists
    if (!File::exists($csvFile)) {
        $this->command->error("CSV file does not exist at path: $csvFile");
        return;
    }

    // Open and read the file
        if (($handle = fopen($csvFile, 'r')) !== FALSE) {
            // Get the headers
            $headers = fgetcsv($handle, 0, ','); // 0 means no length limit

            if ($headers === FALSE) {
                $this->command->error("Failed to read headers from CSV file.");
                return;
            }

            // Loop through each row of the file
            while (($row = fgetcsv($handle, 0, ',')) !== FALSE) { // 0 means no length limit
                $data = array_combine($headers, $row);

                if ($data === FALSE) {
                    $this->command->error("Failed to combine headers with row data.");
                    continue;
                }

                // Validate and insert data into the table
                try {
                    DB::table('national_health_facility')->insert($data);
                } catch (\Exception $e) {
                    $this->command->error("Failed to insert data: " . $e->getMessage());
                }
            }

            // Close the file
            fclose($handle);
        } else {
            $this->command->error("Failed to open CSV file.");
        }
    }

}
