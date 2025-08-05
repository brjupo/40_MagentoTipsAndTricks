# Infraestructure Details

| **Web Servers**      | **CPU** | **Memory** | **Free SSD** | **SO**              | **IP**  |
|----------------------|---------|------------|--------------|---------------------|---------|
| Mag247-Web1          | 32      | 64         | 200          | Ubuntu Server 24.04 | 0.0.0.0 |
| Mag247-Web2          | 32      | 64         | 200          | Ubuntu Server 24.04 | 0.0.0.1 |
| Mag247-Web3          | 32      | 64         | 200          | Ubuntu Server 24.04 | 0.0.0.2 |
|                      |         |            |              |                     |         |
| **Database Servers** | **CPU** | **Memory** | **Free SSD** | **SO**              | **IP**  |
| Mag247-BdMaster      | 16      | 32         | 200          | Ubuntu Server 24.04 | 0.0.0.3 |
| Mag247-BdSlave       | 16      | 32         | 200          | Ubuntu Server 24.04 | 0.0.0.4 |
|                      |         |            |              |                     |         |
| **Services Servers** | **CPU** | **Memory** | **Free SSD** | **SO**              | **IP**  |
| Mag247-OpenSearch    | 16      | 32         | 128          | Ubuntu Server 24.04 | 0.0.0.5 |
| Mag247-Redis         |         |            |              |                     | 0.0.0.5 |
