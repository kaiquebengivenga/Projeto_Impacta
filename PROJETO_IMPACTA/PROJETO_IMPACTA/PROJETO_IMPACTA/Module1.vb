Imports System.Data.SQLite
Imports System.IO

Module Module1
    Public banco As String = "Data Source=" & Path.Combine(Application.StartupPath, "banco\banco.db;Version=3")

    Public Function cria_conexao() As SQLiteConnection
        Dim conexao As New SQLiteConnection(banco)
        Try
            conexao.Open()
            Return conexao
        Catch ex As Exception
            MsgBox("Erro de conexão!")
            Return Nothing
        End Try
    End Function
End Module

