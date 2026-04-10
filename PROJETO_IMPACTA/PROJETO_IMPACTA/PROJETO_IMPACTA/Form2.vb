Imports System.Data.SQLite

Public Class Form2
    Private conexao As SQLiteConnection

    Private Sub Form1_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        conexao = cria_conexao()
        txt_id_aluno.Focus()
        cmd_turma.Items.Clear()

        cmd_turma.Items.Add("1º Informática")
        cmd_turma.Items.Add("2º Informática")
        cmd_turma.Items.Add("3º Informática")

    End Sub

    Private Sub ProfessorToolStripMenuItem_Click(sender As Object, e As EventArgs) Handles ProfessorToolStripMenuItem.Click
        Me.Hide()
        Dim form3 As New Form3()
        form3.Show()
    End Sub

    Private Sub SairToolStripMenuItem_Click(sender As Object, e As EventArgs) Handles SairToolStripMenuItem.Click
        Application.Exit()
    End Sub

    Private Sub btn_adicionar_Click(sender As Object, e As EventArgs) Handles btn_adicionar.Click
        Dim insert_usuarios As String = "INSERT INTO usuarios (usuario, senha, nome, turma, user_level, id_usuario) VALUES (@usuario, @senha, @nome, @turma, @user_level, @id_usuario)"
        Dim insert_logins As String = "INSERT INTO logins (usuario, senha, user_level, ativo, id_usuario) VALUES (@usuario, @senha, @user_level, @ativo, @id_usuario)"

        Try
            ' Inserir o novo aluno na tabela usuarios com um valor temporário para id_usuario
            Dim comando_usuarios As New SQLiteCommand(insert_usuarios, conexao)
            comando_usuarios.Parameters.AddWithValue("@usuario", txt_usuario_aluno.Text)
            comando_usuarios.Parameters.AddWithValue("@senha", txt_senha_aluno.Text)
            comando_usuarios.Parameters.AddWithValue("@nome", txt_nome_aluno.Text)
            comando_usuarios.Parameters.AddWithValue("@turma", cmd_turma.Text)
            comando_usuarios.Parameters.AddWithValue("@user_level", 1)
            comando_usuarios.Parameters.AddWithValue("@id_usuario", -1) ' Valor temporário

            comando_usuarios.ExecuteNonQuery()

            ' Obter o ID gerado automaticamente
            Dim idAluno As Integer
            Dim comandoId As New SQLiteCommand("SELECT last_insert_rowid()", conexao)
            idAluno = Convert.ToInt32(comandoId.ExecuteScalar())

            ' Atualizar o campo id_usuario na tabela usuarios com o valor correto
            Dim update_usuarios As String = "UPDATE usuarios SET id_usuario = @id_usuario WHERE id = @id"
            Dim comandoUpdateUsuarios As New SQLiteCommand(update_usuarios, conexao)
            comandoUpdateUsuarios.Parameters.AddWithValue("@id_usuario", idAluno)
            comandoUpdateUsuarios.Parameters.AddWithValue("@id", idAluno)

            comandoUpdateUsuarios.ExecuteNonQuery()

            ' Inserir o registro na tabela logins com o valor correto do id_usuario
            Dim comando_logins As New SQLiteCommand(insert_logins, conexao)
            comando_logins.Parameters.AddWithValue("@usuario", txt_usuario_aluno.Text)
            comando_logins.Parameters.AddWithValue("@senha", txt_senha_aluno.Text)
            comando_logins.Parameters.AddWithValue("@user_level", 1)
            comando_logins.Parameters.AddWithValue("@ativo", 1)
            comando_logins.Parameters.AddWithValue("@id_usuario", idAluno)

            comando_logins.ExecuteNonQuery()

            txt_id_aluno.Text = idAluno.ToString()

            MessageBox.Show("Registros inseridos com sucesso!")

        Catch ex As Exception
            MessageBox.Show("Erro ao inserir registros: " & ex.Message)
        End Try
    End Sub
    Private Sub btn_limpar_Click(sender As Object, e As EventArgs) Handles btn_limpar.Click
        txt_id_aluno.Text = String.Empty
        txt_nome_aluno.Text = String.Empty
        txt_senha_aluno.Text = String.Empty
        txt_usuario_aluno.Text = String.Empty
        lbl_ativo.Text = String.Empty
        cmd_turma.Items.Clear()
        cmd_turma.Items.Add("")
        cmd_turma.Items.Add("1º Informática")
        cmd_turma.Items.Add("2º Informática")
        cmd_turma.Items.Add("3º Informática")
        cmd_turma.SelectedIndex = 0
    End Sub

    Private Sub cmd_turma_SelectedIndexChanged(sender As Object, e As EventArgs) Handles cmd_turma.SelectedIndexChanged
    End Sub

    Private Sub btn_procurar_Click(sender As Object, e As EventArgs) Handles btn_procurar.Click
        Dim idProcurado As Integer = Integer.Parse(txt_id_aluno.Text)

        Dim consulta As String = "SELECT u.id, u.usuario, u.senha, u.nome, u.turma, l.ativo " &
                         "FROM usuarios u " &
                         "LEFT JOIN logins l ON u.id = l.id_usuario " &
                         "WHERE u.id = @id"

        Try
            Dim comando As New SQLiteCommand(consulta, conexao)

            comando.Parameters.AddWithValue("@id", idProcurado)

            Dim leitor As SQLiteDataReader = comando.ExecuteReader()

            If leitor.Read() Then
                txt_usuario_aluno.Text = leitor("usuario").ToString()
                txt_senha_aluno.Text = leitor("senha").ToString()
                txt_nome_aluno.Text = leitor("nome").ToString()
                cmd_turma.Text = leitor("turma").ToString()

                If leitor("ativo") IsNot DBNull.Value Then
                    Dim ativo As Integer = Convert.ToInt32(leitor("ativo"))

                    If ativo = 1 Then
                        lbl_ativo.Text = "Ativo"
                    Else
                        lbl_ativo.Text = "Inativo"
                    End If
                Else
                    lbl_ativo.Text = "Não disponível"
                End If
            Else
                MessageBox.Show("Nenhum registro encontrado com o ID fornecido.")
            End If

            leitor.Close()

        Catch ex As Exception
            MessageBox.Show("Erro ao procurar registro: " & ex.Message)
        End Try
    End Sub

    Private Sub btn_atualizar_Click(sender As Object, e As EventArgs) Handles btn_atualizar.Click
        Dim idProcurado As Integer = Integer.Parse(txt_id_aluno.Text)

        Dim atualizacao_usuarios As String = "UPDATE usuarios SET usuario = @usuario, senha = @senha, nome = @nome, turma = @turma WHERE id_usuario = @id AND user_level = @user_level"
        Dim atualizacao_logins As String = "UPDATE logins SET usuario = @usuario, senha = @senha WHERE id_usuario = @id AND user_level = @user_level"

        Try
            Dim comando_usuarios As New SQLiteCommand(atualizacao_usuarios, conexao)
            Dim comando_logins As New SQLiteCommand(atualizacao_logins, conexao)

            comando_usuarios.Parameters.AddWithValue("@id", idProcurado)
            comando_usuarios.Parameters.AddWithValue("@usuario", txt_usuario_aluno.Text)
            comando_usuarios.Parameters.AddWithValue("@senha", txt_senha_aluno.Text)
            comando_usuarios.Parameters.AddWithValue("@nome", txt_nome_aluno.Text)
            comando_usuarios.Parameters.AddWithValue("@turma", cmd_turma.Text)
            comando_usuarios.Parameters.AddWithValue("@user_level", 1)

            comando_logins.Parameters.AddWithValue("@id", idProcurado)
            comando_logins.Parameters.AddWithValue("@usuario", txt_usuario_aluno.Text)
            comando_logins.Parameters.AddWithValue("@senha", txt_senha_aluno.Text)
            comando_logins.Parameters.AddWithValue("@user_level", 1)

            Dim linhasAfetadasUsu As Integer = comando_usuarios.ExecuteNonQuery()
            Dim linhasAfetadasLogs As Integer = comando_logins.ExecuteNonQuery()

            If linhasAfetadasUsu > 0 And linhasAfetadasLogs > 0 Then
                MessageBox.Show("Registro atualizado com sucesso!")
            Else
                MessageBox.Show("Nenhum registro encontrado com o ID fornecido para atualização.")
            End If

        Catch ex As Exception
            MessageBox.Show("Erro ao atualizar registro: " & ex.Message)
        End Try
    End Sub


    Private Sub btn_inativar_Click(sender As Object, e As EventArgs) Handles btn_inativar.Click
        Dim idInativar As Integer = Integer.Parse(txt_id_aluno.Text)

        Dim inativar As String = "UPDATE logins SET ativo = @inativo WHERE id = @id"

        Try
            Dim comando As New SQLiteCommand(inativar, conexao)

            comando.Parameters.AddWithValue("@id", idInativar)
            comando.Parameters.AddWithValue("@inativo", 0)

            Dim linhasAfetadas As Integer = comando.ExecuteNonQuery()

            If linhasAfetadas > 0 Then
                MessageBox.Show("Aluno inativado com sucesso!")
            Else
                MessageBox.Show("Nenhum registro encontrado com o ID fornecido para inativação.")
            End If
        Catch ex As Exception
            MessageBox.Show("Erro ao inativar aluno: " & ex.Message)
        End Try
    End Sub


    Private Sub btn_ativar_Click(sender As Object, e As EventArgs) Handles btn_ativar.Click
        Dim idInativar As Integer = Integer.Parse(txt_id_aluno.Text)

        Dim inativar As String = "UPDATE logins SET ativo = @inativo WHERE id = @id"

        Try
            Dim comando As New SQLiteCommand(inativar, conexao)

            comando.Parameters.AddWithValue("@id", idInativar)
            comando.Parameters.AddWithValue("@inativo", 1)

            Dim linhasAfetadas As Integer = comando.ExecuteNonQuery()

            If linhasAfetadas > 0 Then
                MessageBox.Show("Aluno ativado com sucesso!")
            Else
                MessageBox.Show("Nenhum registro encontrado com o ID fornecido para inativação.")
            End If
        Catch ex As Exception
            MessageBox.Show("Erro ao inativar aluno: " & ex.Message)
        End Try
    End Sub
End Class
