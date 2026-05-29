# los_4_Trabajos

Repositorio para los 4 trabajos pedidos de la tarea.

Se usaron 4 ramas distintas para cada trabajo, se puede intercambiar y ver cada uno (para evitar hacer 4 repositorios distintos)

## Usar este comando en PowerShell/CMD de VS Code para cuando se quiera iniciar (instalara las dependencias node_modules necesarias)

```sh
npm install
```

### Comando para alzar el servidor local

```sh
npm run dev
```

### Comando para alzar el db.json (Se necesita la app esa de Postman para que sirva)

```sh
npx json-server --watch db.json --port 3000
```