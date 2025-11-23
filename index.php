<?php
// index.php - Página principal com PHP integrado
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoftTech - Transformando negócios através da tecnologia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <header id="cabecalho" class="cabecalho">
        <div class="container conteudo-cabecalho">
            <div class="logo">
                <div class="icone-logo">
                    <span>ST</span>
                </div>
                <div class="texto-logo">
                    <h1>SoftTech</h1>
                    <p>Bem-vindo à SoftTech</p>
                </div>
            </div>
            <div>
                <?php if(isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <span style="color: var(--pedra-700);">Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</span>
                        <?php if($_SESSION['usuario_tipo'] === 'admin'): ?>
                            <a href="admin/" class="botao botao-secundario" style="text-decoration: none;">
                                <i class="fas fa-user-shield"></i> Admin
                            </a>
                        <?php endif; ?>
                        <button id="botao-logout" class="botao botao-secundario">Sair</button>
                    </div>
                <?php else: ?>
                    <button id="botao-login" class="botao botao-primario">Faça seu Login</button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Menu Lateral -->
    <nav class="menu-lateral">
        <div class="itens-menu">
            <a href="#inicio" class="item-menu ativo" data-secao="inicio">
                <div class="icone-menu">
                    <i class="fas fa-home"></i>
                </div>
                <span class="texto-menu">Início</span>
            </a>
            <a href="#parceiros" class="item-menu" data-secao="parceiros">
                <div class="icone-menu">
                    <i class="fas fa-users"></i>
                </div>
                <span class="texto-menu">Nossos Parceiros</span>
            </a>
            <a href="#seja-parceiro" class="item-menu" data-secao="seja-parceiro">
                <div class="icone-menu">
                    <i class="fas fa-handshake"></i>
                </div>
                <span class="texto-menu">Seja um Parceiro</span>
            </a>
            <a href="#trabalhe-conosco" class="item-menu" data-secao="trabalhe-conosco">
                <div class="icone-menu">
                    <i class="fas fa-briefcase"></i>
                </div>
                <span class="texto-menu">Trabalhe Conosco</span>
            </a>
        </div>
    </nav>

    <main>
        <!-- Seção Hero -->
        <section id="inicio" class="hero secao">
            <div class="container conteudo-hero">
                <div class="hero-esquerda">
                    <div class="logo-hero">
                        <div class="icone-logo-hero">
                            <span>ST</span>
                        </div>
                    </div>
                    <h1 class="titulo-hero">Bem-vindo à SoftTech</h1>
                    <p class="descricao-hero">
                        Transformando negócios através da tecnologia. Soluções inovadoras para empresas que buscam excelência e resultados extraordinários.
                    </p>
                    <div class="botoes-hero">
                        <a href="#parceiros" class="botao botao-primario">Conheça Nossas Soluções</a>
                        <a href="#seja-parceiro" class="botao botao-secundario">Seja um Parceiro</a>
                    </div>
                    <div class="estatisticas-hero">
                        <div class="estatistica">
                            <div class="numero-estatistica">500+</div>
                            <div class="texto-estatistica">Clientes Atendidos</div>
                        </div>
                        <div class="estatistica">
                            <div class="numero-estatistica">15+</div>
                            <div class="texto-estatistica">Anos de Experiência</div>
                        </div>
                        <div class="estatistica">
                            <div class="numero-estatistica">98%</div>
                            <div class="texto-estatistica">Satisfação</div>
                        </div>
                    </div>
                </div>
                <div class="hero-direita">
                    <div class="imagem-hero">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80" alt="Equipe trabalhando">
                    </div>
                    <div class="decoracao-hero-1"></div>
                    <div class="decoracao-hero-2"></div>
                </div>
            </div>
        </section>

        <!-- Seção Parceiros -->
        <section id="parceiros" class="parceiros secao">
            <div class="container">
                <div class="cabecalho-parceiros">
                    <div>
                        <h2 class="titulo-secao">Nossos Parceiros</h2>
                        <p class="subtitulo-secao">
                            Atendemos diversos setores do mercado com soluções personalizadas e tecnologia de ponta exclusivos para cada tipo de negócio.
                        </p>
                    </div>
                    <div class="imagem-parceiros">
                        <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=800&q=80" alt="Parceiros">
                    </div>
                </div>
                <div class="grade-segmentos">
                    <div class="cartao-segmento">
                        <div class="imagem-segmento">
                            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&q=80" alt="Comércio">
                            <div class="icone-segmento" style="background: linear-gradient(to bottom right, var(--laranja-500), var(--laranja-600));">
                                <i class="fas fa-store"></i>
                            </div>
                        </div>
                        <div class="conteudo-segmento">
                            <h3 class="titulo-segmento">Comércio</h3>
                            <p class="descricao-segmento">
                                Soluções completas para gestão de lojas e pontos de venda, com controle de estoque e vendas.
                            </p>
                        </div>
                    </div>

                    <div class="cartao-segmento">
                        <div class="imagem-segmento">
                            <img src="https://images.unsplash.com/photo-1556742044-3c52d6e88c62?w=800&q=80" alt="Varejo">
                            <div class="icone-segmento" style="background: linear-gradient(to bottom right, #2563eb, #1d4ed8);">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="conteudo-segmento">
                            <h3 class="titulo-segmento">Varejo</h3>
                            <p class="descricao-segmento">
                                Sistemas integrados para grandes redes varejistas com análise de dados e relatórios avançados com I.A.
                            </p>
                        </div>
                    </div>

                    <div class="cartao-segmento">
                        <div class="imagem-segmento">
                            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80" alt="Empresas">
                            <div class="icone-segmento" style="background: linear-gradient(to bottom right, var(--ambar-700), var(--ambar-800));">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <div class="conteudo-segmento">
                            <h3 class="titulo-segmento">Empresas</h3>
                            <p class="descricao-segmento">
                                Plataformas corporativas robustas para gestão empresarial, e atendimento exclusivo ao cliente.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção Seja Parceiro -->
        <section id="seja-parceiro" class="seja-parceiro secao">
            <div class="container">
                <div class="conteudo-parceiro">
                    <div class="texto-parceiro">
                        <h2 class="titulo-secao">Seja um Parceiro</h2>
                        <p class="subtitulo-secao">
                            Junte-se à nossa rede de parceiros e expanda seus negócios com as melhores soluções tecnológicas do mercado.
                        </p>
                        <div class="lista-beneficios">
                            <div class="item-beneficio">
                                <div class="check-beneficio">
                                    <span>✓</span>
                                </div>
                                <span class="texto-beneficio">Suporte técnico especializado</span>
                            </div>
                            <div class="item-beneficio">
                                <div class="check-beneficio">
                                    <span>✓</span>
                                </div>
                                <span class="texto-beneficio">Treinamentos exclusivos</span>
                            </div>
                            <div class="item-beneficio">
                                <div class="check-beneficio">
                                    <span>✓</span>
                                </div>
                                <span class="texto-beneficio">Softwares únicos</span>
                            </div>
                            <div class="item-beneficio">
                                <div class="check-beneficio">
                                    <span>✓</span>
                                </div>
                                <span class="texto-beneficio">Material de marketing</span>
                            </div>
                            <div class="item-beneficio">
                                <div class="check-beneficio">
                                    <span>✓</span>
                                </div>
                                <span class="texto-beneficio">Crescimento conjunto</span>
                            </div>
                        </div>
                        <button id="botao-parceiro" class="botao botao-primario">Quero ser Parceiro!</button>
                    </div>
                    <div class="imagem-parceiro">
                        <img src="https://images.unsplash.com/photo-1579532582937-16c108930bf6?w=800&q=80" alt="Seja um Parceiro">
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção Trabalhe Conosco -->
        <section id="trabalhe-conosco" class="trabalhe-conosco secao">
            <div class="container">
                <div class="conteudo-trabalhe">
                    <div class="imagem-trabalhe">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80" alt="Trabalhe Conosco">
                        <div class="decoracao-trabalhe-1"></div>
                        <div class="decoracao-trabalhe-2"></div>
                    </div>
                    <div class="texto-trabalhe">
                        <h2 class="titulo-secao">Trabalhe Conosco</h2>
                        <p class="subtitulo-secao">
                            Faça parte de uma equipe inovadora e apaixonada por tecnologia. Venha construir o futuro conosco.
                        </p>
                        <div class="lista-vantagens">
                            <div class="item-vantagem">
                                <div class="numero-vantagem">
                                    <span>1</span>
                                </div>
                                <div class="conteudo-vantagem">
                                    <h4>Ambiente Inovador</h4>
                                    <p>Trabalhe com as tecnologias mais modernas</p>
                                </div>
                            </div>
                            <div class="item-vantagem">
                                <div class="numero-vantagem">
                                    <span>2</span>
                                </div>
                                <div class="conteudo-vantagem">
                                    <h4>O maior conforto</h4>
                                    <p>Plano de carreira Home Office</p>
                                </div>
                            </div>
                            <div class="item-vantagem">
                                <div class="numero-vantagem">
                                    <span>3</span>
                                </div>
                                <div class="conteudo-vantagem">
                                    <h4>Treinamentos contínuos</h4>
                                    <p>Pacote de benefícios caso haja excelência</p>
                                </div>
                            </div>
                            <div class="item-vantagem">
                                <div class="numero-vantagem">
                                    <span>4</span>
                                </div>
                                <div class="conteudo-vantagem">
                                    <h4>Flexibilidade</h4>
                                    <p>Salário compatível e horários flexíveis</p>
                                </div>
                            </div>
                        </div>
                        <button id="botao-candidato" class="botao botao-primario">Envie seu currículo!</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Rodapé -->
        <footer id="rodape" class="rodape">
            <div class="container">
                <div class="conteudo-rodape">
                    <div class="sobre-rodape">
                        <div class="logo-rodape">
                            <div class="icone-logo-rodape">
                                <span>ST</span>
                            </div>
                            <div class="texto-logo-rodape">SoftTech</div>
                        </div>
                        <p class="descricao-rodape">
                            Transformando negócios através da tecnologia desde 2008. Soluções inovadoras para empresas que buscam excelência.
                        </p>
                    </div>
                    <div class="secao-rodape">
                        <h4>Links Rápidos</h4>
                        <ul class="links-rodape">
                            <li><a href="#inicio">Início</a></li>
                            <li><a href="#parceiros">Nossos Parceiros</a></li>
                            <li><a href="#seja-parceiro">Seja um Parceiro</a></li>
                            <li><a href="#trabalhe-conosco">Trabalhe Conosco</a></li>
                        </ul>
                    </div>
                    <div class="social-rodape">
                        <h4>Redes Sociais</h4>
                        <div class="links-sociais">
                            <a href="#" class="link-social" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="link-social" title="Email">
                                <i class="fas fa-envelope"></i>
                            </a>
                            <a href="#" class="link-social" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="link-social" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                        <div class="info-contato">
                            <a href="mailto:contato@softtech.com">
                                <i class="fas fa-envelope"></i>
                                contato@softtech.com
                            </a>
                            <a href="tel:+5511999999999">
                                <i class="fas fa-phone"></i>
                                (11) 99999-9999
                            </a>
                        </div>
                    </div>
                </div>
                <div class="rodape-inferior">
                    <p>© 2024 SoftTech. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
    </main>

    <!-- Modal Login/Registro -->
    <div id="modal-login" class="overlay-modal">
        <div class="modal">
            <button id="fechar-modal" class="fechar-modal">&times;</button>
            <div class="cabecalho-modal">
                <div class="logo-modal">
                    <span>ST</span>
                </div>
                <h3 class="titulo-modal" id="titulo-modal">Faça seu Login</h3>
                <p class="subtitulo-modal" id="subtitulo-modal">Acesse sua conta SoftTech</p>
            </div>
            
            <!-- Formulário de Login -->
            <form id="formulario-login" style="display: block;">
                <div class="grupo-formulario">
                    <label for="email-login" class="rotulo-formulario">E-mail</label>
                    <input type="email" id="email-login" class="entrada-formulario" placeholder="seu@email.com" required>
                </div>
                <div class="grupo-formulario">
                    <label for="senha-login" class="rotulo-formulario">Senha</label>
                    <input type="password" id="senha-login" class="entrada-formulario" placeholder="••••••••" required>
                </div>
                <button type="submit" class="botao botao-primario" style="width: 100%;">Entrar</button>
                <a href="#" id="link-registro" class="link-formulario">Não tem uma conta? Cadastre-se</a>
            </form>

            <!-- Formulário de Registro -->
            <form id="formulario-registro" style="display: none;">
                <div class="grupo-formulario">
                    <label for="nome-registro" class="rotulo-formulario">Nome Completo</label>
                    <input type="text" id="nome-registro" class="entrada-formulario" placeholder="Seu nome" required>
                </div>
                <div class="grupo-formulario">
                    <label for="email-registro" class="rotulo-formulario">E-mail</label>
                    <input type="email" id="email-registro" class="entrada-formulario" placeholder="seu@email.com" required>
                </div>
                <div class="grupo-formulario">
                    <label for="telefone-registro" class="rotulo-formulario">Telefone</label>
                    <input type="tel" id="telefone-registro" class="entrada-formulario" placeholder="(11) 99999-9999">
                </div>
                <div class="grupo-formulario">
                    <label for="senha-registro" class="rotulo-formulario">Senha</label>
                    <input type="password" id="senha-registro" class="entrada-formulario" placeholder="••••••••" required>
                </div>
                <button type="submit" class="botao botao-primario" style="width: 100%;">Cadastrar</button>
                <a href="#" id="link-login" class="link-formulario">Já tem uma conta? Faça login</a>
            </form>
        </div>
    </div>

    <!-- Modal Parceiro -->
    <div id="modal-parceiro" class="overlay-modal">
        <div class="modal" style="max-width: 600px;">
            <button class="fechar-modal" onclick="fecharModal('modal-parceiro')">&times;</button>
            <div class="cabecalho-modal">
                <div class="logo-modal">
                    <span>ST</span>
                </div>
                <h3 class="titulo-modal">Seja um Parceiro</h3>
                <p class="subtitulo-modal">Preencha os dados da sua empresa</p>
            </div>
            <form id="formulario-parceiro">
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">Nome da Empresa</label>
                    <input type="text" name="nome_empresa" class="entrada-formulario" required>
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">CNPJ</label>
                    <input type="text" name="cnpj" class="entrada-formulario" placeholder="00.000.000/0000-00">
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">Segmento</label>
                    <select name="segmento" class="entrada-formulario" required>
                        <option value="">Selecione...</option>
                        <option value="comercio">Comércio</option>
                        <option value="varejo">Varejo</option>
                        <option value="empresas">Empresas</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">Descrição do Negócio</label>
                    <textarea name="descricao" class="entrada-formulario" rows="3"></textarea>
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">Cidade/Estado</label>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 12px;">
                        <input type="text" name="cidade" class="entrada-formulario" placeholder="Cidade">
                        <input type="text" name="estado" class="entrada-formulario" placeholder="UF" maxlength="2">
                    </div>
                </div>
                <button type="submit" class="botao botao-primario" style="width: 100%;">Enviar Solicitação</button>
            </form>
        </div>
    </div>

    <!-- Modal Candidato -->
    <div id="modal-candidato" class="overlay-modal">
        <div class="modal" style="max-width: 600px;">
            <button class="fechar-modal" onclick="fecharModal('modal-candidato')">&times;</button>
            <div class="cabecalho-modal">
                <div class="logo-modal">
                    <span>ST</span>
                </div>
                <h3 class="titulo-modal">Trabalhe Conosco</h3>
                <p class="subtitulo-modal">Envie sua candidatura</p>
            </div>
            <form id="formulario-candidato" enctype="multipart/form-data">
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">Nome Completo</label>
                    <input type="text" name="nome_completo" class="entrada-formulario" required>
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">CPF</label>
                    <input type="text" name="cpf" class="entrada-formulario" placeholder="000.000.000-00">
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">Cargo de Interesse</label>
                    <input type="text" name="cargo_interesse" class="entrada-formulario" required>
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">Nível de Experiência</label>
                    <select name="nivel_experiencia" class="entrada-formulario">
                        <option value="">Selecione...</option>
                        <option value="junior">Júnior</option>
                        <option value="pleno">Pleno</option>
                        <option value="senior">Sênior</option>
                        <option value="especialista">Especialista</option>
                    </select>
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">Currículo (PDF)</label>
                    <input type="file" name="curriculo" class="entrada-formulario" accept=".pdf,.doc,.docx">
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">LinkedIn</label>
                    <input type="url" name="linkedin" class="entrada-formulario" placeholder="https://linkedin.com/in/seu-perfil">
                </div>
                <div class="grupo-formulario">
                    <label class="rotulo-formulario">Disponibilidade</label>
                    <select name="disponibilidade" class="entrada-formulario">
                        <option value="imediata">Imediata</option>
                        <option value="15_dias">15 dias</option>
                        <option value="30_dias">30 dias</option>
                        <option value="a_combinar">A combinar</option>
                    </select>
                </div>
                <button type="submit" class="botao botao-primario" style="width: 100%;">Enviar Candidatura</button>
            </form>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>