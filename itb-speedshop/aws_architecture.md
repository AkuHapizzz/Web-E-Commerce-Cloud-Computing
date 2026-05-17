# Diagram Arsitektur AWS

Berikut adalah diagram arsitektur *Deployment* di AWS (diadaptasi dari gambar yang Anda berikan untuk menyesuaikan dengan aplikasi Laravel e-commerce ini).

```mermaid
flowchart LR
    %% Definisi Entitas Eksternal
    Users("👥 External Users<br>(Mahasiswa)")
    Developer("👤 Developer")

    %% AWS Cloud Area
    subgraph AWS["☁️ AWS Cloud"]
        
        subgraph Region["AWS Region: ap-southeast-3 (Jakarta)"]
            
            IGW(("🚪 IGW<br>(Internet Gateway)"))
            
            subgraph VPC["VPC (Simplified Campus Network) - CIDR '10.0.0.0/16'"]
                
                subgraph Subnet["Public Subnet (Simplified Deployment Zone) - CIDR '10.0.1.0/24'"]
                    
                    subgraph SG["Security Group (Allow Port 80/443 & SSH)"]
                        
                        EC2["🖥️ EC2 Instance<br>(Web Server, App Server & PostgreSQL DB)<br><br>⚡ Laravel Web App<br>🐘 PostgreSQL"]
                        
                    end
                end
            end
        end
        
        %% S3 Berada di luar VPC namun tetap di dalam ekosistem AWS
        S3[("🪣 S3 Bucket<br>(Product Images Storage)")]
    end

    %% Hubungan dan Alur Data
    Users -- "User traffic" --> IGW
    Developer -- "Git Push" --> IGW

    IGW -- "User traffic" --> EC2
    IGW -- "Git Push" --> EC2

    EC2 -- "AWS SDK" --> S3
    S3 -- "AWS SDK" --> EC2

    %% Styling (Mendekati warna AWS di gambar)
    style AWS fill:#ffffff,stroke:#232f3e,stroke-width:2px
    style Region fill:#f9f9f9,stroke:#00a4a6,stroke-width:2px,stroke-dasharray: 5 5
    style VPC fill:#ffffff,stroke:#1d8900,stroke-width:2px
    style Subnet fill:#e6ffe6,stroke:#1d8900,stroke-width:1px
    style SG fill:#fff0f0,stroke:#ff4f8b,stroke-width:1px
    style EC2 fill:#ffcc80,stroke:#ff9900,stroke-width:2px
    style S3 fill:#40b000,stroke:#232f3e,stroke-width:2px,color:#fff
```

### Penjelasan Arsitektur:
1. **External Users & Developer**: Pengguna dari luar dan developer mengakses sistem melalui jaringan publik.
2. **IGW (Internet Gateway)**: Sebagai gerbang utama yang menghubungkan jaringan publik (internet) dengan jaringan VPC di AWS.
3. **VPC & Public Subnet**: Jaringan terisolasi (Virtual Private Cloud) dengan konfigurasi CIDR blok untuk mengamankan instance. Karena menggunakan *Simplified Deployment Zone*, EC2 diletakkan pada Public Subnet.
4. **Security Group**: Berfungsi sebagai *firewall* virtual yang hanya membuka port yang diizinkan, yaitu:
   - **Port 80 (HTTP) & 443 (HTTPS)** untuk *User traffic* ke website.
   - **Port 22 (SSH)** untuk Developer (*Git Push* / *Remote access*).
5. **EC2 Instance**: Virtual Machine (Server) yang menjalankan secara sekaligus (*All-in-One*):
   - Web Server (contoh: Nginx/Apache)
   - App Server (Aplikasi Laravel E-Commerce Anda)
   - Database (PostgreSQL)
   *(Sesuai gambar, aslinya Next.js namun diganti ke Laravel agar sesuai dengan tumpukan teknologi project ini).*
6. **S3 Bucket**: Tempat penyimpanan eksternal berkinerja tinggi untuk file gambar produk, diakses oleh aplikasi (EC2) menggunakan *AWS SDK*.
