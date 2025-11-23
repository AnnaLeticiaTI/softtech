// assets/js/script.js - JavaScript do Sistema SoftTech

// Elementos do DOM
const cabecalho = document.getElementById('cabecalho');
const itensMenu = document.querySelectorAll('.item-menu');
const botaoLogin = document.getElementById('botao-login');
const botaoLogout = document.getElementById('botao-logout');
const modalLogin = document.getElementById('modal-login');
const fecharModal = document.getElementById('fechar-modal');
const formularioLogin = document.getElementById('formulario-login');
const formularioRegistro = document.getElementById('formulario-registro');
const linkRegistro = document.getElementById('link-registro');
const linkLogin = document.getElementById('link-login');
const botaoParceiro = document.getElementById('botao-parceiro');
const botaoCandidato = document.getElementById('botao-candidato');
const formularioParceiro = document.getElementById('formulario-parceiro');
const formularioCandidato = document.getElementById('formulario-candidato');

// Configurações da API
const API_BASE_URL = 'api';

// Funções de Utilidade
function mostrarMensagem(mensagem, tipo = 'success') {
    const cor = tipo === 'success' ? '#10b981' : '#ef4444';
    const icone = tipo === 'success' ? '✓' : '✕';
    
    const div = document.createElement('div');
    div.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${cor};
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        z-index: 10000;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideIn 0.3s ease;
    `;
    div.innerHTML = `<span style="font-size: 20px;">${icone}</span><span>${mensagem}</span>`;
    document.body.appendChild(div);
    
    setTimeout(() => {
        div.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => div.remove(), 300);
    }, 3000);
}

function abrirModal(idModal) {
    const modal = document.getElementById(idModal);
    if (modal) {
        modal.classList.add('ativo');
    }
}

function fecharModalFunc(idModal) {
    const modal = document.getElementById(idModal);
    if (modal) {
        modal.classList.remove('ativo');
    }
}

window.fecharModal = fecharModalFunc;

function verificarAutenticacao() {
    return fetch(`${API_BASE_URL}/auth/check.php`)
        .then(response => response.json())
        .then(data => data.logado)
        .catch(() => false);
}

// Navegação e Menu
function rolarParaSecao(idSecao) {
    const secao = document.getElementById(idSecao);
    if (secao) {
        secao.scrollIntoView({ behavior: 'smooth' });
    }
}

function atualizarMenuAtivo() {
    const scrollY = window.scrollY;
    const secoes = ['inicio', 'parceiros', 'seja-parceiro', 'trabalhe-conosco'];
    
    if (scrollY > 50) {
        cabecalho.classList.add('rolado');
    } else {
        cabecalho.classList.remove('rolado');
    }
    
    let secaoAtiva = 'inicio';
    
    for (let i = secoes.length - 1; i >= 0; i--) {
        const secao = document.getElementById(secoes[i]);
        if (secao) {
            const offsetTop = secao.offsetTop - 100;
            if (scrollY >= offsetTop) {
                secaoAtiva = secoes[i];
                break;
            }
        }
    }
    
    itensMenu.forEach(item => {
        item.classList.remove('ativo');
        if (item.getAttribute('data-secao') === secaoAtiva) {
            item.classList.add('ativo');
        }
    });
}

// Event Listeners - Menu
window.addEventListener('scroll', atualizarMenuAtivo);

itensMenu.forEach(item => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        const idSecao = item.getAttribute('data-secao');
        rolarParaSecao(idSecao);
    });
});

// Event Listeners - Modais
if (botaoLogin) {
    botaoLogin.addEventListener('click', () => {
        abrirModal('modal-login');
    });
}

if (botaoLogout) {
    botaoLogout.addEventListener('click', () => {
        if (confirm('Deseja realmente sair?')) {
            fetch(`${API_BASE_URL}/auth/logout.php`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mostrarMensagem('Logout realizado com sucesso!');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    mostrarMensagem('Erro ao fazer logout', 'error');
                });
        }
    });
}

if (fecharModal) {
    fecharModal.addEventListener('click', () => {
        fecharModalFunc('modal-login');
    });
}

if (modalLogin) {
    modalLogin.addEventListener('click', (e) => {
        if (e.target === modalLogin) {
            fecharModalFunc('modal-login');
        }
    });
}

// Alternar entre Login e Registro
if (linkRegistro) {
    linkRegistro.addEventListener('click', (e) => {
        e.preventDefault();
        formularioLogin.style.display = 'none';
        formularioRegistro.style.display = 'block';
        document.getElementById('titulo-modal').textContent = 'Criar Conta';
        document.getElementById('subtitulo-modal').textContent = 'Cadastre-se na SoftTech';
    });
}

if (linkLogin) {
    linkLogin.addEventListener('click', (e) => {
        e.preventDefault();
        formularioRegistro.style.display = 'none';
        formularioLogin.style.display = 'block';
        document.getElementById('titulo-modal').textContent = 'Faça seu Login';
        document.getElementById('subtitulo-modal').textContent = 'Acesse sua conta SoftTech';
    });
}

// Formulário de Login
if (formularioLogin) {
    formularioLogin.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const email = document.getElementById('email-login').value;
        const senha = document.getElementById('senha-login').value;
        
        const botaoSubmit = formularioLogin.querySelector('button[type="submit"]');
        botaoSubmit.disabled = true;
        botaoSubmit.textContent = 'Entrando...';
        
        fetch(`${API_BASE_URL}/auth/login.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email, senha })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarMensagem('Login realizado com sucesso!');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                mostrarMensagem(data.message || 'Erro ao fazer login', 'error');
                botaoSubmit.disabled = false;
                botaoSubmit.textContent = 'Entrar';
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            mostrarMensagem('Erro ao conectar com o servidor', 'error');
            botaoSubmit.disabled = false;
            botaoSubmit.textContent = 'Entrar';
        });
    });
}

// Formulário de Registro
if (formularioRegistro) {
    formularioRegistro.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const nome = document.getElementById('nome-registro').value;
        const email = document.getElementById('email-registro').value;
        const telefone = document.getElementById('telefone-registro').value;
        const senha = document.getElementById('senha-registro').value;
        
        if (senha.length < 6) {
            mostrarMensagem('A senha deve ter no mínimo 6 caracteres', 'error');
            return;
        }
        
        const botaoSubmit = formularioRegistro.querySelector('button[type="submit"]');
        botaoSubmit.disabled = true;
        botaoSubmit.textContent = 'Cadastrando...';
        
        fetch(`${API_BASE_URL}/auth/registro.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ nome, email, telefone, senha })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarMensagem('Cadastro realizado com sucesso! Faça login.');
                setTimeout(() => {
                    linkLogin.click();
                    formularioRegistro.reset();
                }, 2000);
            } else {
                mostrarMensagem(data.message || 'Erro ao criar conta', 'error');
            }
            botaoSubmit.disabled = false;
            botaoSubmit.textContent = 'Cadastrar';
        })
        .catch(error => {
            console.error('Erro:', error);
            mostrarMensagem('Erro ao conectar com o servidor', 'error');
            botaoSubmit.disabled = false;
            botaoSubmit.textContent = 'Cadastrar';
        });
    });
}

// Botão Seja Parceiro
if (botaoParceiro) {
    botaoParceiro.addEventListener('click', async () => {
        const autenticado = await verificarAutenticacao();
        if (!autenticado) {
            mostrarMensagem('Você precisa estar logado para se tornar parceiro', 'error');
            abrirModal('modal-login');
            return;
        }
        abrirModal('modal-parceiro');
    });
}

// Botão Trabalhe Conosco
if (botaoCandidato) {
    botaoCandidato.addEventListener('click', async () => {
        const autenticado = await verificarAutenticacao();
        if (!autenticado) {
            mostrarMensagem('Você precisa estar logado para enviar candidatura', 'error');
            abrirModal('modal-login');
            return;
        }
        abrirModal('modal-candidato');
    });
}

// Fechar modais ao clicar fora
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('overlay-modal')) {
        e.target.classList.remove('ativo');
    }
});

// Formulário Parceiro
if (formularioParceiro) {
    formularioParceiro.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const formData = new FormData(formularioParceiro);
        const data = Object.fromEntries(formData);
        
        const botaoSubmit = formularioParceiro.querySelector('button[type="submit"]');
        botaoSubmit.disabled = true;
        botaoSubmit.textContent = 'Enviando...';
        
        fetch(`${API_BASE_URL}/parceiros/cadastrar.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarMensagem('Solicitação enviada com sucesso! Entraremos em contato em breve.');
                formularioParceiro.reset();
                setTimeout(() => {
                    fecharModalFunc('modal-parceiro');
                }, 2000);
            } else {
                mostrarMensagem(data.message || 'Erro ao enviar solicitação', 'error');
            }
            botaoSubmit.disabled = false;
            botaoSubmit.textContent = 'Enviar Solicitação';
        })
        .catch(error => {
            console.error('Erro:', error);
            mostrarMensagem('Erro ao conectar com o servidor', 'error');
            botaoSubmit.disabled = false;
            botaoSubmit.textContent = 'Enviar Solicitação';
        });
    });
}

// Formulário Candidato
if (formularioCandidato) {
    formularioCandidato.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const formData = new FormData(formularioCandidato);
        
        const botaoSubmit = formularioCandidato.querySelector('button[type="submit"]');
        botaoSubmit.disabled = true;
        botaoSubmit.textContent = 'Enviando...';
        
        fetch(`${API_BASE_URL}/candidatos/cadastrar.php`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarMensagem('Candidatura enviada com sucesso! Entraremos em contato em breve.');
                formularioCandidato.reset();
                setTimeout(() => {
                    fecharModalFunc('modal-candidato');
                }, 2000);
            } else {
                mostrarMensagem(data.message || 'Erro ao enviar candidatura', 'error');
            }
            botaoSubmit.disabled = false;
            botaoSubmit.textContent = 'Enviar Candidatura';
        })
        .catch(error => {
            console.error('Erro:', error);
            mostrarMensagem('Erro ao conectar com o servidor', 'error');
            botaoSubmit.disabled = false;
            botaoSubmit.textContent = 'Enviar Candidatura';
        });
    });
}

// Máscaras para inputs
function aplicarMascaraTelefone(input) {
    if (!input) return;
    input.addEventListener('input', (e) => {
        let valor = e.target.value.replace(/\D/g, '');
        if (valor.length <= 11) {
            valor = valor.replace(/^(\d{2})(\d)/g, '($1) $2');
            valor = valor.replace(/(\d)(\d{4})$/, '$1-$2');
        }
        e.target.value = valor;
    });
}

function aplicarMascaraCNPJ(input) {
    if (!input) return;
    input.addEventListener('input', (e) => {
        let valor = e.target.value.replace(/\D/g, '');
        valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
        valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
        valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
        e.target.value = valor;
    });
}

function aplicarMascaraCPF(input) {
    if (!input) return;
    input.addEventListener('input', (e) => {
        let valor = e.target.value.replace(/\D/g, '');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = valor;
    });
}

// Aplicar máscaras nos campos
const inputTelefone = document.getElementById('telefone-registro');
if (inputTelefone) aplicarMascaraTelefone(inputTelefone);

const inputCNPJ = document.querySelector('input[name="cnpj"]');
if (inputCNPJ) aplicarMascaraCNPJ(inputCNPJ);

const inputCPF = document.querySelector('input[name="cpf"]');
if (inputCPF) aplicarMascaraCPF(inputCPF);

// Adicionar animações CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Inicializar
atualizarMenuAtivo();

console.log('Sistema SoftTech inicializado com sucesso!');