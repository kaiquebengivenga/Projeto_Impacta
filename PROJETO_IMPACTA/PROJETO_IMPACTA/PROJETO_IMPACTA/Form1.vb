Imports System.Data.SQLite

Public Class Form1
    Private conexao As SQLiteConnection

    Private Sub Form1_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        txt_usuario.Focus()
        conexao = cria_conexao()
    End Sub

    Private Sub btn_logar_Click(sender As Object, e As EventArgs) Handles btn_logar.Click
        Dim usuario As String = txt_usuario.Text
        Dim senha As String = txt_senha.Text

        If String.IsNullOrEmpty(usuario) Or String.IsNullOrEmpty(senha) Then
            MessageBox.Show("Por favor, preencha o nome de usuário e a senha.")
            Return
        End If

        Dim consulta As String = "SELECT COUNT(*) FROM login_direcao WHERE nome_usuario = @usuario AND senha = @senha"

        Try
            Dim comando As New SQLiteCommand(consulta, conexao)
            comando.Parameters.AddWithValue("@usuario", usuario)
            comando.Parameters.AddWithValue("@senha", senha)

            Dim resultado As Integer = CInt(comando.ExecuteScalar())

            If resultado > 0 Then
                Me.Hide()
                Dim form2 As New Form2()
                form2.Show()
            Else
                MessageBox.Show("Nome de usuário ou senha incorretos. Tente novamente.")
            End If
        Catch ex As Exception
            MessageBox.Show("Erro ao verificar o login: " & ex.Message)
        End Try
    End Sub

    Private Sub btn_olho_Click_1(sender As Object, e As EventArgs) Handles btn_olho.Click
        If txt_senha.PasswordChar = "•"c Then
            txt_senha.PasswordChar = ControlChars.NullChar
            btn_olho.Image = My.Resources.olho_vb
        Else
            txt_senha.PasswordChar = "•"c
            btn_olho.Image = My.Resources.olho_riscado_vb
        End If
    End Sub
End Class
