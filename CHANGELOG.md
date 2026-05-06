# Changelog - ETH Estratégias

Todas as mudanças notáveis neste projeto serão documentadas neste arquivo.

## [2.0.0] - 2026-05-06
### Adicionado
- Integração global de **FilePond Premium** (Drag & Drop, ProgressBar, PT-BR).
- Sistema de temas **Dark/Light** nativo no painel administrativo.
- Botões de exclusão individual em todas as listagens principais.
- Notificações **Toasty** para feedback de operações rápidas.
- Confirmações **SweetAlert2** padronizadas globalmente.
- Novo campo de "Upload Rápido" na central de mídias.

### Modificado
- Upgrade do core para **Laravel 12** e **PHP 8.4**.
- Layout administrativo refatorado para **AdminLTE 4 Premium**.
- Editor **Summernote** atualizado com suporte a Dark Mode e toolbar customizada.
- Visual de tabelas e formulários otimizado com Bootstrap 5.
- `README.md` atualizado com novas especificações técnicas.

### Corrigido
- Falha na deleção em massa de mídias (correção de nomes de parâmetros).
- Erro 404/500 em rotas de exclusão singular (implementação de métodos `destroy`).
- Tags HTML expostas em campos de descrição e títulos.
- Configuração do `HTMLPurifier` para evitar injeção de `<p>` indesejados.
- Unlink de arquivos órfãos ao deletar registros do banco de dados.

---
*Desenvolvido por Marcelo Brad RJ*
