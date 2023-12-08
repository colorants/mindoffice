<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;

class ImportData extends Command
{


    protected $signature = 'import:data';
    protected $description = 'Import data from JSON to database';

    public function handle()
    {
        $jsonString = '[
  {
    "companies": {
      "name": "beeld Bedrijf 1",
      "kvk": "12345678",
      "btw": "NL123456789B01",
      "country_id": "157"
    },
    "adresses": [
      {
        "type": "bezoekadres",
        "street": "Hoofdstreet",
        "housenumberr": "123",
        "zipcode": "1234 AB",
        "city": "Stad",
        "country_id": "157"
      },
      {
        "type": "afleveradres",
        "street": "Zijstreet",
        "housenumber": "456",
        "zipcode": "5678 CD",
        "city": "Dorp",
        "country_id": "157"
      }
    ],
    "users": [
      {
        "name": "John",
        "last_name": "Doe",
        "email": "john.doe@example.com",
        "house-phone": "012-3456789",
        "mobile-phone": "987654321",
        "notes": "Belangrijke contactpersoon"
      },
      {
        "name": "Jane",
        "last_name": "Smith",
        "email": "jane.smith@example.com",
        "house-phone": "012-9876543",
        "mobile-phone": "123456789",
        "notes": "Inkoopafdeling"
      }
    ]
  },
  {
    "companies": {
      "name": "beeld Bedrijf 2",
      "kvk": "87654321",
      "btw": "NL987654321B01",
      "country_id": "157"
    },
    "adresses": [
      {
        "type": "bezoekadres",
        "streetname": "Centrumplein",
        "housenumber": "789",
        "zipcode": "9012 XY",
        "city": "Stad",
        "country_id": "157"
      }
    ],
    "users": [
      {
        "name": "Bob",
        "last_name": "Johnson",
        "email": "bob.johnson@example.com",
        "house-phone": "012-3456789",
        "mobile-phone": "987654321",
        "notes": "Technisch contactpersoon"
      }
    ]
  },
  {
    "companies": {
      "name": "ABC Elektronica",
      "kvk": "98765432",
      "btw": "NL987654321B02",
      "country_id": "157"
    },
    "adresses": [
      {
        "type": "bezoekadres",
        "streetname": "Technologieweg",
        "housenumber": "456",
        "zipcode": "5432 DC",
        "city": "Techstad",
        "country_id": "157"
      },
      {
        "type": "afleveradres",
        "streetname": "Logistiekstreet",
        "housenumber": "789",
        "zipcode": "6789 AB",
        "city": "Opslagstad",
        "country_id": "157"
      }
    ],
    "users": [
      {
        "name": "Eva",
        "last_name": "Vries",
        "email": "eva.vries@abc-elektronica.com",
        "house-phone": "012-3456789",
        "mobile-phone": "987654321",
        "notes": "Inkoopmanager"
      },
      {
        "name": "Peter",
        "last_name": "Bos",
        "email": "peter.bos@abc-elektronica.com",
        "house-phone": "012-9876543",
        "mobile-phone": "123456789",
        "notes": "Verkoopmanager"
      }
    ]
  },
  {
    "companies": {
      "name": "Green Solutions BV",
      "kvk": "34567890",
      "btw": "NL567890123B03",
      "country_id": "157"
    },
    "adresses": [
      {
        "type": "bezoekadres",
        "streetname": "Milieustreet",
        "housenumber": "123",
        "zipcode": "4567 EF",
        "city": "Eco Stad",
        "country_id": "157"
      }
    ],
    "users": [
      {
        "name": "Sophie",
        "last_name": "Groen",
        "email": "sophie.groen@greensolutions.com",
        "house-phone": "012-3456789",
        "mobile-phone": "987654321",
        "notes": "Duurzaamheidsexpert"
      }
    ]
  }
]
';  // Replace '...' with your actual JSON string
        $data = json_decode($jsonString, true);

        $pdo = DB::connection()->getPdo();

        foreach ($data as $item) {
            // Insert into companies table
            $name = $item['companies']['name'];
            $kvk = $item['companies']['kvk'];
            $btw = $item['companies']['btw'];
            $country_id = $item['companies']['country_id'];

            // Prepare the statement
            $stmt = $pdo->prepare("INSERT INTO companies (name, kvk, btw, country_id) VALUES (?, ?, ?, ?)");

            // Bind parameters
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $kvk);
            $stmt->bindParam(3, $btw);
            $stmt->bindParam(4, $country_id);

            $stmt->bindParam(5, $id);

            // Execute the statement
            $stmt->execute();
        }


    }
}
