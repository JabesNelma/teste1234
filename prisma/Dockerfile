FROM node:18
WORKDIR /workspace
COPY package.json package-lock.json* ./
RUN npm ci --no-audit --no-fund || npm i
COPY . .
CMD ["npm", "run", "prisma:studio"]
