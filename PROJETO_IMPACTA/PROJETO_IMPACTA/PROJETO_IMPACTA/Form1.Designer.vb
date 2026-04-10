<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()>
Partial Class Form1
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()>
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()>
    Private Sub InitializeComponent()
        Dim resources As ComponentModel.ComponentResourceManager = New ComponentModel.ComponentResourceManager(GetType(Form1))
        txt_senha = New TextBox()
        txt_usuario = New TextBox()
        Label1 = New Label()
        Label2 = New Label()
        PictureBox1 = New PictureBox()
        Label3 = New Label()
        btn_logar = New PictureBox()
        btn_olho = New Button()
        CType(PictureBox1, ComponentModel.ISupportInitialize).BeginInit()
        CType(btn_logar, ComponentModel.ISupportInitialize).BeginInit()
        SuspendLayout()
        ' 
        ' txt_senha
        ' 
        txt_senha.BackColor = Color.WhiteSmoke
        txt_senha.Location = New Point(538, 215)
        txt_senha.Name = "txt_senha"
        txt_senha.PasswordChar = "•"c
        txt_senha.Size = New Size(143, 23)
        txt_senha.TabIndex = 0
        ' 
        ' txt_usuario
        ' 
        txt_usuario.BackColor = Color.WhiteSmoke
        txt_usuario.Location = New Point(538, 136)
        txt_usuario.Name = "txt_usuario"
        txt_usuario.Size = New Size(143, 23)
        txt_usuario.TabIndex = 0
        ' 
        ' Label1
        ' 
        Label1.AutoSize = True
        Label1.Font = New Font("Tahoma", 12F, FontStyle.Regular, GraphicsUnit.Point)
        Label1.ForeColor = Color.MidnightBlue
        Label1.Location = New Point(538, 193)
        Label1.Name = "Label1"
        Label1.Size = New Size(63, 19)
        Label1.TabIndex = 2
        Label1.Text = "Senha :"
        ' 
        ' Label2
        ' 
        Label2.AutoSize = True
        Label2.Font = New Font("Tahoma", 12F, FontStyle.Regular, GraphicsUnit.Point)
        Label2.ForeColor = Color.MidnightBlue
        Label2.Location = New Point(538, 114)
        Label2.Name = "Label2"
        Label2.Size = New Size(74, 19)
        Label2.TabIndex = 3
        Label2.Text = "Usuário :"
        ' 
        ' PictureBox1
        ' 
        PictureBox1.Image = CType(resources.GetObject("PictureBox1.Image"), Image)
        PictureBox1.Location = New Point(-3, 0)
        PictureBox1.Name = "PictureBox1"
        PictureBox1.Size = New Size(407, 456)
        PictureBox1.TabIndex = 5
        PictureBox1.TabStop = False
        ' 
        ' Label3
        ' 
        Label3.Font = New Font("Tahoma", 24F, FontStyle.Regular, GraphicsUnit.Point)
        Label3.ForeColor = Color.MidnightBlue
        Label3.Location = New Point(551, 50)
        Label3.Name = "Label3"
        Label3.Size = New Size(96, 46)
        Label3.TabIndex = 6
        Label3.Text = "Login"
        ' 
        ' btn_logar
        ' 
        btn_logar.Cursor = Cursors.Hand
        btn_logar.Image = CType(resources.GetObject("btn_logar.Image"), Image)
        btn_logar.Location = New Point(538, 268)
        btn_logar.Name = "btn_logar"
        btn_logar.Size = New Size(150, 40)
        btn_logar.TabIndex = 7
        btn_logar.TabStop = False
        ' 
        ' btn_olho
        ' 
        btn_olho.BackColor = Color.Transparent
        btn_olho.BackgroundImage = My.Resources.Resources.olho_vb
        btn_olho.BackgroundImageLayout = ImageLayout.Center
        btn_olho.Location = New Point(687, 215)
        btn_olho.Name = "btn_olho"
        btn_olho.Size = New Size(30, 24)
        btn_olho.TabIndex = 8
        btn_olho.UseVisualStyleBackColor = False
        ' 
        ' Form1
        ' 
        AutoScaleDimensions = New SizeF(7F, 15F)
        AutoScaleMode = AutoScaleMode.Font
        BackColor = Color.WhiteSmoke
        ClientSize = New Size(800, 450)
        Controls.Add(btn_olho)
        Controls.Add(btn_logar)
        Controls.Add(Label3)
        Controls.Add(PictureBox1)
        Controls.Add(Label2)
        Controls.Add(Label1)
        Controls.Add(txt_usuario)
        Controls.Add(txt_senha)
        FormBorderStyle = FormBorderStyle.None
        Icon = CType(resources.GetObject("$this.Icon"), Icon)
        Name = "Form1"
        Text = "School Points"
        CType(PictureBox1, ComponentModel.ISupportInitialize).EndInit()
        CType(btn_logar, ComponentModel.ISupportInitialize).EndInit()
        ResumeLayout(False)
        PerformLayout()
    End Sub

    Friend WithEvents txt_senha As TextBox
    Friend WithEvents txt_usuario As TextBox
    Friend WithEvents Label1 As Label
    Friend WithEvents Label2 As Label
    Friend WithEvents PictureBox1 As PictureBox
    Friend WithEvents Label3 As Label
    Friend WithEvents btn_logar As PictureBox
    Friend WithEvents btn_olho As Button
End Class
