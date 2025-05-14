# PASANTIA_w3CAN

prototype/
├── users/
│   ├── id (PK, BIGINT)
│   ├── user_id (BIGINT)
│   ├── username (VARCHAR, Unique)
│   ├── passwd (VARCHAR)
│   ├── name (VARCHAR)
│   ├── 1surname (VARCHAR)
│   ├── 2surname (VARCHAR)
│   ├── dni (VARCHAR)
│   └── admin (TINYINT, boolean)
│
├── folders/
│   ├── id (PK, INT)
│   ├── user_id (VARCHAR)
│   ├── name (VARCHAR)
│   └── files (VARCHAR)
│
└── files/
    ├── id (PK, INT)
    ├── name (INT)
    ├── user_id (INT)
    ├── size (INT)
    ├── date (TIMESTAMP)
    └── folder_id (INT)