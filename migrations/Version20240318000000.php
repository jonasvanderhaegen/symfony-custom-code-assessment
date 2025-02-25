<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240318000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial restaurant management system schema';
    }

    public function up(Schema $schema): void
    {
        // Drop existing tables if they exist (in reverse order of dependencies)
        $this->addSql('DROP TABLE IF EXISTS orders CASCADE');
        $this->addSql('DROP TABLE IF EXISTS shifts CASCADE');
        $this->addSql('DROP TABLE IF EXISTS tables CASCADE');
        $this->addSql('DROP TABLE IF EXISTS menu_items CASCADE');
        $this->addSql('DROP TABLE IF EXISTS staff CASCADE');
        $this->addSql('DROP TABLE IF EXISTS restaurants CASCADE');

        // Create restaurants table (base table with no dependencies)
        $this->addSql('CREATE TABLE restaurants (
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            address VARCHAR(255) NOT NULL,
            is_active BOOLEAN DEFAULT true NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Create staff table (depends on restaurants)
        $this->addSql('CREATE TABLE staff (
            id VARCHAR(255) NOT NULL,
            restaurant_id INT NOT NULL,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            role VARCHAR(50) NOT NULL,
            is_active BOOLEAN DEFAULT true NOT NULL,
            skills JSON NOT NULL,
            PRIMARY KEY(id),
            UNIQUE INDEX uniq_staff_email (email),
            INDEX idx_staff_role (role),
            INDEX idx_staff_email (email),
            CONSTRAINT FK_staff_restaurant FOREIGN KEY (restaurant_id) 
                REFERENCES restaurants (id) ON DELETE RESTRICT
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Create menu_items table (depends on restaurants)
        $this->addSql('CREATE TABLE menu_items (
            id VARCHAR(255) NOT NULL,
            restaurant_id INT NOT NULL,
            name VARCHAR(255) NOT NULL,
            description TEXT DEFAULT NULL,
            price DECIMAL(10,2) NOT NULL,
            allergens JSON NOT NULL,
            ingredients JSON NOT NULL,
            is_available BOOLEAN DEFAULT true NOT NULL,
            category VARCHAR(50) NOT NULL,
            is_seasonal_item BOOLEAN DEFAULT false NOT NULL,
            PRIMARY KEY(id),
            INDEX idx_menu_item_category (category),
            INDEX idx_menu_item_availability (is_available),
            CONSTRAINT FK_menu_item_restaurant FOREIGN KEY (restaurant_id) 
                REFERENCES restaurants (id) ON DELETE RESTRICT
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Create tables table (depends on restaurants)
        $this->addSql('CREATE TABLE tables (
            id INT NOT NULL AUTO_INCREMENT,
            restaurant_id INT NOT NULL,
            number VARCHAR(50) NOT NULL,
            capacity INT NOT NULL,
            status VARCHAR(50) DEFAULT \'available\' NOT NULL,
            location VARCHAR(50) NOT NULL,
            is_active BOOLEAN DEFAULT true NOT NULL,
            PRIMARY KEY(id),
            CONSTRAINT FK_table_restaurant FOREIGN KEY (restaurant_id) 
                REFERENCES restaurants (id) ON DELETE RESTRICT
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Create shifts table (depends on staff)
        $this->addSql('CREATE TABLE shifts (
            id VARCHAR(255) NOT NULL,
            staff_id VARCHAR(255) NOT NULL,
            start_time DATETIME NOT NULL,
            end_time DATETIME NOT NULL,
            status VARCHAR(50) DEFAULT \'scheduled\' NOT NULL,
            checkin_time DATETIME DEFAULT NULL,
            checkout_time DATETIME DEFAULT NULL,
            breaks JSON NOT NULL,
            PRIMARY KEY(id),
            INDEX idx_shift_start_time (start_time),
            INDEX idx_shift_status (status),
            CONSTRAINT FK_shift_staff FOREIGN KEY (staff_id) 
                REFERENCES staff (id) ON DELETE RESTRICT
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Create orders table (depends on restaurants)
        $this->addSql('CREATE TABLE orders (
            id VARCHAR(255) NOT NULL,
            restaurant_id INT NOT NULL,
            status VARCHAR(20) NOT NULL,
            total_amount DECIMAL(10,2) NOT NULL,
            items JSON NOT NULL,
            table_number VARCHAR(50) DEFAULT NULL,
            special_instructions TEXT DEFAULT NULL,
            created_at DATETIME NOT NULL,
            completed_at DATETIME DEFAULT NULL,
            PRIMARY KEY(id),
            INDEX idx_order_status (status),
            INDEX idx_order_created_at (created_at),
            CONSTRAINT FK_order_restaurant FOREIGN KEY (restaurant_id) 
                REFERENCES restaurants (id) ON DELETE RESTRICT
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // Drop tables in reverse order of dependencies
        $this->addSql('DROP TABLE IF EXISTS orders');
        $this->addSql('DROP TABLE IF EXISTS shifts');
        $this->addSql('DROP TABLE IF EXISTS tables');
        $this->addSql('DROP TABLE IF EXISTS menu_items');
        $this->addSql('DROP TABLE IF EXISTS staff');
        $this->addSql('DROP TABLE IF EXISTS restaurants');
    }
} 