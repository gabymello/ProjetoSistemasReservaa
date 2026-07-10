# 🚀 Como Rodar o Projeto (Passo a Passo)

Sistema de Reservas e Empréstimos — Web (PHP) + Mobile (Android) + Banco (MySQL).

---

## Parte 1 — Banco de Dados + Site (Web)

### 1. Instalar o XAMPP
Baixe e instale o **XAMPP** (https://www.apachefriends.org). Abra o **XAMPP Control Panel** e clique em **Start** no **Apache** e no **MySQL**.

### 2. Copiar o site para o XAMPP
Copie a pasta **`web`** deste projeto para dentro de `C:\xampp\htdocs\` e **renomeie para `reservas`**.
Vai ficar assim:
```
C:\xampp\htdocs\reservas\   (login.php, index.php, api\, etc.)
```
> 💡 O sistema detecta sozinho o caminho da pasta (usando `BASE_URL`), então funciona mesmo
> se você não usar o nome `reservas` — mas a API do app mobile (`urlBase()`) espera que a pasta
> `web` fique na raiz do site (ex.: `htdocs\reservas`), então recomendamos manter esse nome.

### 3. Criar o banco de dados
1. Abra o navegador em **http://localhost/phpmyadmin**
2. Clique na aba **SQL** (no topo).
3. Abra o arquivo **`sql/01_estrutura.sql`**, copie TUDO, cole e clique em **Executar**.
4. Faça o mesmo com **`sql/02_dados_iniciais.sql`**.

### 4. Usuários de teste (já vêm prontos)
O `sql/02_dados_iniciais.sql` do passo anterior já cria os logins abaixo (senha já
criptografada), não precisa rodar mais nada:
- **Admin:** `admin@escola.com` / senha `123456`
- **Usuário:** `aluno@escola.com` / senha `123456`

> Se quiser recriar/atualizar esses dois usuários manualmente, o arquivo
> **http://localhost/reservas/instalar.php** continua disponível e faz isso a qualquer momento.

Quer criar outras contas? Na tela de login tem o link **"Cadastre-se"** — qualquer pessoa pode
se cadastrar sozinha, mas a conta criada por lá é sempre do tipo **usuário comum** (não admin).

### 5. Usar o site
Abra **http://localhost/reservas/login.php** e entre como admin.
- Como **admin**: cadastre Categorias, Setores, Recursos (com foto) e veja todas as reservas.
- Como **aluno**: faça reservas e veja seu histórico.

### 6. Testar a API (opcional)
Abra **http://localhost/reservas/api/api_recursos.php** — deve aparecer um JSON com os recursos.

---

## Parte 2 — Aplicativo Android (Mobile)

### 1. Abrir no Android Studio
Abra o **Android Studio** → **Open** → selecione a pasta **`mobile/ReservasApp`**.
Espere o Gradle sincronizar (baixa as bibliotecas Retrofit/Glide automaticamente).
> Se pedir para gerar o Gradle Wrapper, aceite (ou use *File > Sync Project*).

### 2. Configurar o endereço do servidor (IMPORTANTE)
Abra o arquivo:
`app/src/main/java/com/escola/reservasapp/api/ApiConfig.java`

- **Rodando no EMULADOR** do Android Studio → deixe assim:
  ```java
  public static final String BASE_URL = "http://10.0.2.2/reservas/api/";
  ```
- **Rodando em um CELULAR físico** (na mesma rede Wi-Fi do PC) → troque pelo IP do PC.
  Descubra o IP abrindo o `cmd` e digitando **`ipconfig`** (procure "Endereço IPv4", ex: `192.168.0.15`):
  ```java
  public static final String BASE_URL = "http://192.168.0.15/reservas/api/";
  ```

### 3. Rodar
Clique em **Run ▶**. O app abre na tela de **Login**.
Entre com `aluno@escola.com` / `123456`.

### 4. O que dá pra fazer no app
- Ver a lista de recursos (com foto e nome) — **filtro por categoria** e **busca**.
- Tocar em um recurso → ver detalhes → escolher **data + turno** → **Reservar**.
- Ver **Meu Histórico** de reservas.

> Toda reserva feita no app aparece também no site (Admin > Reservas), marcada como **origem = mobile**. É a integração Web ↔ Mobile ↔ Banco funcionando. ✅

---

## Problemas comuns
| Problema | Solução |
|---|---|
| Site abre em branco / erro de conexão | O MySQL está ligado no XAMPP? Rodou os dois SQLs? |
| App diz "Erro de conexão" | Confira o `BASE_URL` no `ApiConfig.java` (emulador usa `10.0.2.2`). |
| Foto não aparece no app | A foto foi cadastrada pelo admin no site? O Apache está ligado? |
| Login não funciona | Rodou os dois SQLs (o `02_dados_iniciais.sql` já cria os usuários de teste)? Se quiser recriar os logins, abra `instalar.php` uma vez. |
