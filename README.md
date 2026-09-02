# 🛒 SkyGroceries

> Um gerenciador de listas de compras moderno, direto ao ponto e desenvolvido com CakePHP 5.

---

## 📌 Sobre o Projeto

O **SkyGroceries** foi projetado para simplificar a criação e o controle de listas de compras no dia a dia. Com uma interface minimalista e focada em usabilidade, a aplicação permite organizar itens, acompanhar o progresso das compras e atualizar status em tempo real.

O projeto também conta com uma customização arquitetural exclusiva: suporte nativo ao formato de template `*.cake.php`, combinando estilo visual no VS Code com a estabilidade do motor de renderização do CakePHP.

---

## ✨ Funcionalidades

* 📋 **Gerenciamento de Listas:** Crie, visualize e organize múltiplas listas de compras.
* 📦 **Controle de Itens:** Adicione, edite e remova itens associados a cada lista.
* ✅ **Checklist Interativo:** Alterne o status de comprado de cada item de forma rápida.
* 📊 **Progresso Visual:** Barra de progresso para acompanhar o total de itens já adquiridos na lista.
* 🍰 **Custom View Engine:** Resolução dinâmica de templates em `.cake.php` com fallback automático para `.php`.
* 🎨 **Design Moderno:** Interface limpa, responsiva e focada em contraste e leitura rápida.

---

## 🛠️ Tecnologias Utilizadas

* **Linguagem:** PHP 8.1+
* **Framework:** [CakePHP 5.x](https://cakephp.org/)
* **Banco de Dados:** MySQL / PostgreSQL
* **Estilização:** CSS3 puro e customizado com variáveis globais
* **Ferramentas:** Composer, Git

---

## 🚀 Como Executar o Projeto

### Pré-requisitos
* PHP >= 8.1
* Composer instalado
* Banco de dados configurado (MySQL, PostgreSQL ou MariaDB)

### Passo a Passo

1. **Clone o repositório:**
   ```bash
   git clone [https://github.com/seu-usuario/skyGroceries.git](https://github.com/seu-usuario/skyGroceries.git)
   cd skyGroceries


2. Configure as variáveis de ambiente e banco:
Copie o arquivo de exemplo de configuração (caso não tenha o .env):

3. Bash
    cp config/app_local.example.php config/app_local.php
    Edite config/app_local.php adicionando suas credenciais de conexão com o banco de dados.

4. Execute as migrações / importe o schema:

5. Bash
    bin/cake migrations migrate
   
6.  Inicie o servidor de desenvolvimento:
bin/cake server
Acesse a aplicação no navegador em: http://localhost:8765

7. 💡 Configuração Recomendada (VS Code)
Para visualizar os templates com o ícone oficial do CakePHP (.cake.php) na árvore de arquivos usando a extensão Material Icon Theme, adicione ao seu settings.json:

8. JSON
"material-icon-theme.files.associations": {
  "*.cake.php": "cake"
},
"files.associations": {
  "*.cake.php": "php"
}
9. 📄 Licença
Este projeto está sob a licença MIT.