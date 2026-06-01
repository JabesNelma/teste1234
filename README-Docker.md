# Run with Docker (Windows-compatible)

This repository includes a Docker development setup for the CodeIgniter app and an optional Prisma service for DB introspection.

Prerequisites (Windows): 
- Docker Desktop (use WSL2 backend recommended)
- If on Windows without WSL2, ensure file sharing is enabled for the project path

Quick start:

```bash
# build and start services
docker compose up -d --build

# open the site at http://localhost:8088
# open prisma studio (after pulling schema) at http://localhost:5555
```

After DB starts, to introspect existing schema into Prisma run:

```bash
# run prisma pull inside the prisma container
docker compose run --rm prisma npm run prisma:pull

# optionally run prisma studio
docker compose run --rm -p 5555:5555 prisma npm run prisma:studio
```

If you see permission issues, ensure the project files are readable by Docker and that `writable/` directory exists and is writeable by the container.

Windows-specific quick run (recommended WSL2):

1. Ensure Docker Desktop uses WSL2 backend and your project is inside your WSL filesystem (e.g., in your home folder) for best performance.
2. Build and start:

```powershell
docker compose up -d --build
```

3. If you need to install PHP dependencies or re-run composer from Windows host, use the PHP container:

```powershell
docker compose exec php composer install
```

4. To reset database (warning: destroys data), remove the `db_data` volume and restart:

```powershell
docker compose down -v
docker compose up -d --build
```

If MySQL import didn't run (because volume already existed), you can import manually:

```powershell
docker compose exec -T db mysql -u root -pvgss_root_pass vgss_grading < /docker-entrypoint-initdb.d/vgss_grading.sql
```

Default host ports used by this setup:
- App (nginx): `8088`
- MySQL: `3308`
- Prisma Studio: `5555` (only when command is started with `-p 5555:5555`)
- Prefer WSL2 and Docker Desktop for best filesystem performance.
- If you see permission issues, ensure the project files are readable by Docker and that `writable/` directory exists and is writeable by the container.

Security note: The DB credentials in `.env.example` are for local development only. Do not use them in production.
