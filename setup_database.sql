-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS Elektra CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Drop the user if it exists and recreate it
DROP USER IF EXISTS 'elektra_user'@'localhost';
CREATE USER 'elektra_user'@'localhost' IDENTIFIED BY 'STANJO.O4##';

-- Grant all privileges on the Elektra database
GRANT ALL PRIVILEGES ON Elektra.* TO 'elektra_user'@'localhost';

-- Flush privileges to apply changes
FLUSH PRIVILEGES;

-- Show the grants to verify
SHOW GRANTS FOR 'elektra_user'@'localhost';
