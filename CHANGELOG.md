# Changelog - ETH Estratégias

Todas as alterações notáveis neste projeto serão documentadas neste arquivo.

## [Unreleased]
### Planejado / Em Andamento
- **Atualização de Core:** Migração do Laravel 8 para Laravel 12.
- **Atualização de PHP:** Migração do PHP 7.3/8.0 para PHP 8.3/8.4.
- **Painel Administrativo:** Migração do tema SB Admin 2 (Bootstrap 4) para AdminLTE 4 (Bootstrap 5).
- **Editores e Uploads:** Substituição do Dropzone pelo FilePond e TinyMCE pelo Summernote no painel administrativo.
- **Notificações:** Padronização global de alertas usando SweetAlert2 e Toasty Notify via chamadas AJAX.
- **Documentação:** Estabelecimento de direitos autorais para Marcelo Brad RJ e sanitização da base de código legada.

## [2.0.0] - 2026-05-06
### Adicionado
- **FilePond Premium:** Implementação global de upload com Drag & Drop, barra de progresso animada e feedback de tempo real.
- **Summernote Premium:** Configuração de editor de texto rico com suporte a código e modo tela cheia.
- **Dark Mode:** Implementação de suporte nativo a temas Light/Dark no painel administrativo.
- **Exclusão Individual:** Adicionados botões de exclusão direta em todas as listagens (Posts, Páginas, Serviços, etc.).
- **SweetAlert2 Global:** Integração de confirmações premium para todas as ações destrutivas.

### Corrigido
- **Sistema de Deleção:** Correção global da exclusão em massa e individual em todos os módulos (Usuários, Mídias, Posts, Páginas, Serviços, Depoimentos, Clientes, Membros, Idiomas, Categorias).
- **Rotas de Deleção:** Padronização das rotas `DELETE` e alinhamento com os formulários Blade.
- **Segurança:** Sanitização de conteúdos HTML expostos usando HTMLPurifier (`clean()`).
- **Upload de Mídias:** Correção da lógica de salvamento e resposta JSON para o FilePond.
- **Exclusão Física:** Implementada a remoção física de arquivos do servidor ao deletar mídias.

### Alterado
- **Design AdminLTE 4:** Refatoração completa das views de listagem e edição para o padrão Premium (Cards modulares, 2 colunas para edição).
- **UX/UI:** Padronização de botões, cores (curadoria HSL) e micro-transições.
- **Tradução:** Alinhamento de todas as strings para Português Brasileiro nativo.

## [1.0.0] - 2026-05-06
### Adicionado
- Importação da versão original de produção (Laravel 8) do servidor da ETH Estratégias para o repositório local e remoto.
- Sincronização direta configurada via SSH local-to-production usando remote `production`.
