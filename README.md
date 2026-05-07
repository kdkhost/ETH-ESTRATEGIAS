# ETH Estratégias

## Sobre o Sistema
O **ETH Estratégias** é uma plataforma corporativa web gerenciável desenvolvida sob medida. Conta com um painel administrativo poderoso e uma vitrine online robusta, otimizada e responsiva.

## Atualizações Recentes (Maio 2026) - Versão Premium v2.1
Realizamos uma modernização completa da infraestrutura de interface e segurança:

### 🎨 UI/UX & Design System Gourmet v1.5
*   **Design System Gourmet:** Implementação de cards com texturas, bordas de destaque (`Premium Stripe`) e ícones em marca d'água.
*   **Navbar Premium:** Barra superior fixa (Sticky) com efeito Glassmorphism e relógio digital em tempo real (sem refresh).
*   **Experiência Mobile:** Correção do comportamento da sidebar para modo overlay, garantindo que o conteúdo não seja comprimido em telas pequenas.
*   **UX Refinada:** Menu lateral otimizado com rolagem invisível e remoção de redundâncias (Logout centralizado no perfil).
*   **Modo Dark/Light:** Implementação de alternância de temas nativa com persistência em `localStorage`.

### 🛠️ Funcionalidades Premium
*   **Upload Inteligente (FilePond):** Integração global do FilePond com suporte a arraste e solte, barra de progresso animada e plugins de validação/encoding.
*   **Edição de Conteúdo (Summernote):** Refatoração do editor para versão premium com suporte a modo escuro e interface em Português (PT-BR).
*   **Central de Mídias:** Adição de "Upload Rápido" diretamente na galeria e gestão aprimorada de arquivos.
*   **Notificações & Alertas:** Substituição de alertas nativos por **Toasty Notify** e **SweetAlert2** para confirmações e feedback de sucesso/erro.

### 🛡️ Segurança & Estabilidade
*   **Laravel 12 Upgrade:** Sistema totalmente compatível com Laravel 12 e PHP 8.4.
*   **Auditoria de HTML:** Correção de falhas de exposição de código HTML em campos de texto.
*   **Saneamento de Dados:** Configuração refinada do `HTMLPurifier` para evitar injeção de scripts e manter a integridade do layout.
*   **Correção de Fluxos:** Resolução de bugs críticos de exclusão (singular/plural de rotas) e métodos de controlador ausentes (`destroy`).

---

## Direitos Autorais
&copy; Todos os direitos reservados.
**Autor e Desenvolvedor:** Marcelo Brad RJ
*Nenhuma parte deste código, interface, layout ou arquitetura pode ser reproduzida, copiada, distribuída ou vendida sem a autorização expressa do autor.*

## Tecnologias Principais
*   **Backend:** PHP 8.4, Laravel 12 Framework
*   **Frontend Público:** Blade Templates, Bootstrap 4, Vanilla JS/jQuery
*   **Painel Administrativo:** AdminLTE 4, Bootstrap 5, SweetAlert2, FilePond, Summernote, Toasty
*   **Banco de Dados:** MySQL

## Licença
Este sistema é de uso exclusivo da ETH Estratégias e está protegido por leis de direitos autorais. Propriedade Intelectual de Marcelo Brad RJ.
