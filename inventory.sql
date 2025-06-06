---Database: `ahk_workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`

CREATE TABLE inventory (
    inventory_id INT AUTO_INCREMENT PRIMARY KEY,
    inventory_name VARCHAR(100),
    category VARCHAR(100),
    sku VARCHAR(50),
    price DECIMAL(10,2),
    stock INT,
    status VARCHAR(50)
);

 ["Air Filter", "Engine Components", "AF-002", "RM 45", 30, "Low Stock"],
    ["Brake Pad", "Brakes", "BP-009", "RM 120", 75, "In Stock"],
    ["Oil Filter", "Engine Components", "OF-014", "RM 35", 10, "Low Stock"],
    ["Wiper Blade", "Accessories", "WB-007", "RM 25", 90, "In Stock"],
];