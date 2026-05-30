# Diagramas do Projeto Impacta

Os diagramas abaixo foram montados a partir dos arquivos PHP do projeto e do banco SQLite em `projetoimpacta/projetoimpacta/bin/Debug/net6.0-windows/banco/banco.db`.

## Diagrama de Classes

> Observacao: o projeto esta escrito de forma procedural em PHP. Por isso, este diagrama representa as entidades do dominio e os principais modulos PHP como classes conceituais.

```mermaid
classDiagram
    direction LR

    class Usuario {
        +int id
        +int id_usuario
        +string usuario
        +string senha
        +int pontos
        +int user_level
        +string nome
        +string turma
        +consultarPontos()
        +resgatarProduto(produto_id)
        +verHistorico()
    }

    class Professor {
        +int id
        +int id_usuario
        +string usuario
        +string senha
        +string nome
        +int user_level
        +filtrarTurma(turma)
        +atualizarPontos()
    }

    class Login {
        +int id
        +int id_usuario
        +string usuario
        +string senha
        +int user_level
        +int ativo
        +autenticar(usuario, senha)
        +redirecionarPorNivel()
    }

    class Produto {
        +int produto_id
        +int pontos_necessarios
        +validarPontos(usuario)
    }

    class CodigoResgatado {
        +int id
        +int id_usuario
        +string codigo
        +string data_resgate
        +registrarCodigo()
        +listarPorUsuario(id_usuario)
        +excluirHistorico(id_usuario)
    }

    class Sessao {
        +string usuario
        +int usuario_id
        +string pagina_anterior
        +bool mostrar_qrcode
        +bool erro_pop_up
        +iniciar()
        +encerrar()
    }

    class BancoSQLite {
        +PDO conexao
        +consultar()
        +inserir()
        +atualizar()
        +excluir()
    }

    class AuthController {
        +login.php
        +cadastro.php
        +sair.php
        +erro_login.php
    }

    class AlunoController {
        +dashboard.php
        +pagina_de_item.php
        +resgate.php
        +resgate_item2.php
        +resgate_item3.php
        +resgate_item4.php
        +resgate_item5.php
        +resgate_item6.php
        +resgate_item7.php
        +resgate_item8.php
        +resgate_item9.php
        +codigo.php
        +mostrar_qr_code.php
        +erro_resgate.php
    }

    class ProfessorController {
        +dashboard_professor.php
        +update_pontos.php
        +pontos_atualizados.php
    }

    class HistoricoController {
        +codigos_resgatados.php
        +delete.php
    }

    class QRCodeService {
        +generateRandomCode()
        +renderizarSVG(codigo)
    }

    BancoSQLite ..> Usuario
    BancoSQLite ..> Professor
    BancoSQLite ..> Login
    BancoSQLite ..> Produto
    BancoSQLite ..> CodigoResgatado

    Login --> Usuario : autentica aluno
    Login --> Professor : autentica professor
    Usuario "1" --> "0..*" CodigoResgatado : possui
    Usuario "1" --> "0..*" Produto : resgata
    Produto "1" --> "0..*" CodigoResgatado : gera resgate
    Professor --> Usuario : atribui pontos

    AuthController ..> Login
    AuthController ..> Sessao
    AlunoController ..> Usuario
    AlunoController ..> Produto
    AlunoController ..> CodigoResgatado
    AlunoController ..> QRCodeService
    ProfessorController ..> Professor
    ProfessorController ..> Usuario
    HistoricoController ..> CodigoResgatado
```

## Diagrama de Caso de Uso

```mermaid
flowchart LR
    Aluno([Aluno])
    Professor([Professor])
    Sistema[School Points]

    UC_Login((Fazer login))
    UC_Sair((Sair))
    UC_VerDashboard((Ver dashboard))
    UC_VerPontos((Consultar pontos))
    UC_ListarProdutos((Ver recompensas))
    UC_VerProduto((Ver detalhes da recompensa))
    UC_Resgatar((Resgatar recompensa))
    UC_ValidarPontos((Validar pontos suficientes))
    UC_DescontarPontos((Descontar pontos))
    UC_GerarQR((Gerar QR Code))
    UC_SalvarCodigo((Salvar codigo resgatado))
    UC_CopiarCodigo((Copiar codigo))
    UC_VerHistorico((Ver historico de resgates))
    UC_LimparHistorico((Limpar historico))
    UC_VerSobre((Ver pagina sobre nos))

    UC_VerAreaProfessor((Ver area do professor))
    UC_ListarAlunos((Listar alunos))
    UC_FiltrarTurma((Filtrar por turma))
    UC_AtribuirPontos((Atribuir pontos))
    UC_AtualizarPresenca((Pontuar presenca))
    UC_AtualizarTrabalho((Pontuar trabalho))
    UC_AtualizarProva((Pontuar prova))
    UC_ConfirmarAtualizacao((Confirmar pontos atualizados))

    Aluno --> UC_Login
    Aluno --> UC_Sair
    Aluno --> UC_VerDashboard
    Aluno --> UC_VerPontos
    Aluno --> UC_ListarProdutos
    Aluno --> UC_VerProduto
    Aluno --> UC_Resgatar
    Aluno --> UC_CopiarCodigo
    Aluno --> UC_VerHistorico
    Aluno --> UC_LimparHistorico
    Aluno --> UC_VerSobre

    Professor --> UC_Login
    Professor --> UC_Sair
    Professor --> UC_VerAreaProfessor
    Professor --> UC_ListarAlunos
    Professor --> UC_FiltrarTurma
    Professor --> UC_AtribuirPontos

    UC_Resgatar --> UC_ValidarPontos
    UC_Resgatar --> UC_DescontarPontos
    UC_Resgatar --> UC_GerarQR
    UC_Resgatar --> UC_SalvarCodigo

    UC_AtribuirPontos --> UC_AtualizarPresenca
    UC_AtribuirPontos --> UC_AtualizarTrabalho
    UC_AtribuirPontos --> UC_AtualizarProva
    UC_AtribuirPontos --> UC_ConfirmarAtualizacao

    Sistema -. controla .- UC_Login
    Sistema -. controla .- UC_Resgatar
    Sistema -. controla .- UC_AtribuirPontos
```

## Principais Arquivos Relacionados

- Autenticacao: `cadastro.php`, `login.php`, `sair.php`, `erro_login.php`
- Area do aluno: `dashboard.php`, `pagina_de_item.php`, `resgate.php`, `resgate_item2.php` a `resgate_item9.php`
- Resgate e QR Code: `codigo.php`, `mostrar_qr_code.php`, `gerar_qr_code.php`
- Historico: `codigos_resgatados.php`, `delete.php`
- Area do professor: `dashboard_professor.php`, `update_pontos.php`, `pontos_atualizados.php`
- Banco de dados: `usuarios`, `professores`, `logins`, `produtos`, `codigo_resgatado`, `login_direcao`
