# Fleet Tracker Documentation

## Table of Contents
1. [Project Structure](#project-structure)
2. [Database Schema](#database-schema)
3. [Installation & Setup](#installation--setup)
4. [Running the Application](#running-the-application)
5. [Available Routes](#available-routes)

---

## Project Structure
```
fleet-tracker/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ShipmentController.php
│   │   │   ├── FleetController.php
│   │   │   ├── BookingController.php
│   │   │   ├── CheckinController.php
│   │   │   └── ReportController.php
│   │   └── Requests/
│   │       └── StoreBookingRequest.php
│   └── Models/
│       ├── Shipment.php
│   │   ├── Fleet.php
│   │   ├── Booking.php
│   │   └── Checkin.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   ├── FleetSeeder.php
│   │   └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/app.blade.php
│       ├── shipments/
│       │   ├── track-form.blade.php
│       │   ├── track-result.blade.php
│       │   └── index.blade.php
│       ├── fleets/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── bookings/
│       │   └── create.blade.php
│       ├── checkins/
│       │   ├── create.blade.php
│       │   └── index.blade.php
│       └── reports/
│           └── in_transit.blade.php
├── routes/
│   └── web.php
├── .env.example
├── composer.json
└── README.md
```

## Database Schema

### `fleets`
| Column        | Type             | Notes                     |
|---------------|------------------|---------------------------|
| `id`          | bigint PK AI     |                           |
| `number`      | string (unique)  | Nomor armada              |
| `type`        | string           | Jenis kendaraan           |
| `is_available`| boolean          | Tersedia / Tidak tersedia|
| `capacity`    | integer          | Kapasitas muatan          |

### `shipments`
| Column            | Type                | Notes                      |
|-------------------|---------------------|----------------------------|
| `id`              | bigint PK AI        |                            |
| `tracking_number` | string (unique)     | Nomor tracking             |
| `shipped_at`      | date                | Tanggal pengiriman         |
| `origin`          | string              | Lokasi asal                |
| `destination`     | string              | Lokasi tujuan              |
| `status`          | enum                | pending, in_transit, delivered |
| `goods_detail`    | text                | Deskripsi barang           |

### `bookings`
| Column         | Type         | Notes                           |
|----------------|--------------|---------------------------------|
| `id`           | bigint PK AI |                                 |
| `fleet_id`     | bigint FK    | References `fleets.id`          |
| `shipment_id`  | bigint FK    | References `shipments.id`       |
| `booking_date` | date         | Tanggal pemesanan armada        |

### `checkins`
| Column      | Type         | Notes                           |
|-------------|--------------|---------------------------------|
| `id`        | bigint PK AI |                                 |
| `fleet_id`  | bigint FK    | References `fleets.id`          |
| `latitude`  | decimal(10,7)| Koordinat latitude              |
| `longitude` | decimal(10,7)| Koordinat longitude             |

---

## Installation & Setup

1. **Clone repository**
   ```bash
   git clone https://github.com/your-org/fleet-tracker.git
   cd fleet-tracker
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install      # kalau ada asset frontend
   ```

3. **Configure environment**
   - Copy `.env.example` ke `.env`
   - Sesuaikan koneksi database di `.env`:
     ```dotenv
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=fleet_tracker
     DB_USERNAME=root
     DB_PASSWORD=1234
     ```

4. **Generate app key**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan migrasi & seeder**
   ```bash
   php artisan migrate --seed
   ```

6. **Build assets (opsional)**
   ```bash
   npm run dev
   ```

---

## Running the Application

```bash
php artisan serve
```

Aplikasi akan tersedia di `http://127.0.0.1:8000`.

---

## Available Routes

| Method | URI                      | Action                              |
|--------|--------------------------|-------------------------------------|
| GET    | /track                   | form tracking shipment              |
| POST   | /track                   | submit tracking                     |
| GET    | /shipments               | list & search shipments             |
| GET    | /fleets                  | list & filter fleets                |
| GET    | /fleets/create           | create fleet form                   |
| POST   | /fleets                  | store new fleet                     |
| GET    | /fleets/{fleet}/edit     | edit fleet form                     |
| PUT    | /fleets/{fleet}          | update fleet                        |
| DELETE | /fleets/{fleet}          | delete fleet                        |
| GET    | /bookings/create         | form booking                        |
| POST   | /bookings                | store booking                       |
| GET    | /checkins/create         | form check-in                       |
| POST   | /checkins                | store check-in                      |
| GET    | /checkins                | map view check-ins                  |
| GET    | /reports/in-transit      | report shipments in transit per fleet|

---

