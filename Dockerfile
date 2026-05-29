#1: Construcción (Build)
#Se usa Node para descargar las dependencias y compilar el código de Vue
FROM node:18
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
#Esto crea la carpeta /dist con el HTML/CSS/JS optimizado
RUN npm run build

#2: Servidor Web (Producción)
#Usar un servidor web ultra ligero (Nginx) para mostrar tu app al mundo
FROM nginx:1.19.0-alpine
#Copiar la carpeta /dist de la etapa 1 a la carpeta pública del servidor
COPY --from=0 /app/dist /usr/share/nginx/html
#Exponemr el puerto estándar de internet (80)
EXPOSE 80
#Encender el servidor
CMD ["nginx", "-g", "daemon off;"]