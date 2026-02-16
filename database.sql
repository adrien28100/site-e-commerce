CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL, -- évite les doublons 
    password VARCHAR(255) NOT NULL, -- les mdp seront haché via password_hash
    role VARCHAR(50) DEFAULT 'user' -- pour l'accès admin
);

-- produits
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255)
);

-- commandes
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_item INT,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id_item) REFERENCES items(id) ON DELETE CASCADE
);

-- facture
CREATE TABLE invoice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
    montant DECIMAL(10, 2),
    adresse_facturation TEXT,
    ville VARCHAR(100),
    code_postal VARCHAR(20),
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_item INT,
    quantite_item_en_stock INT,
    FOREIGN KEY (id_item) REFERENCES items(id) ON DELETE CASCADE
);