<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Form3
    Inherits System.Windows.Forms.Form

    'Descartar substituições de formulário para limpar a lista de componentes.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Exigido pelo Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'OBSERVAÇÃO: o procedimento a seguir é exigido pelo Windows Form Designer
    'Pode ser modificado usando o Windows Form Designer.  
    'Não o modifique usando o editor de códigos.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Dim resources As ComponentModel.ComponentResourceManager = New ComponentModel.ComponentResourceManager(GetType(Form3))
        MenuStrip1 = New MenuStrip()
        AlunoToolStripMenuItem = New ToolStripMenuItem()
        ProfessorToolStripMenuItem = New ToolStripMenuItem()
        SairToolStripMenuItem = New ToolStripMenuItem()
        Label4 = New Label()
        Label3 = New Label()
        Label2 = New Label()
        txt_id_aluno = New TextBox()
        txt_senha_aluno = New TextBox()
        txt_usuario_aluno = New TextBox()
        txt_nome_aluno = New TextBox()
        Label1 = New Label()
        btn_limpar = New PictureBox()
        btn_inativar = New PictureBox()
        btn_atualizar = New PictureBox()
        btn_adicionar = New PictureBox()
        btn_procurar = New PictureBox()
        PictureBox2 = New PictureBox()
        PictureBox1 = New PictureBox()
        Label5 = New Label()
        lbl_ativo = New Label()
        btn_ativar = New PictureBox()
        MenuStrip1.SuspendLayout()
        CType(btn_limpar, ComponentModel.ISupportInitialize).BeginInit()
        CType(btn_inativar, ComponentModel.ISupportInitialize).BeginInit()
        CType(btn_atualizar, ComponentModel.ISupportInitialize).BeginInit()
        CType(btn_adicionar, ComponentModel.ISupportInitialize).BeginInit()
        CType(btn_procurar, ComponentModel.ISupportInitialize).BeginInit()
        CType(PictureBox2, ComponentModel.ISupportInitialize).BeginInit()
        CType(PictureBox1, ComponentModel.ISupportInitialize).BeginInit()
        CType(btn_ativar, ComponentModel.ISupportInitialize).BeginInit()
        SuspendLayout()
        ' 
        ' MenuStrip1
        ' 
        MenuStrip1.Items.AddRange(New ToolStripItem() {AlunoToolStripMenuItem, ProfessorToolStripMenuItem, SairToolStripMenuItem})
        MenuStrip1.Location = New Point(0, 0)
        MenuStrip1.Name = "MenuStrip1"
        MenuStrip1.Size = New Size(800, 24)
        MenuStrip1.TabIndex = 30
        MenuStrip1.Text = "MenuStrip1"
        ' 
        ' AlunoToolStripMenuItem
        ' 
        AlunoToolStripMenuItem.Font = New Font("Tahoma", 9.75F, FontStyle.Regular, GraphicsUnit.Point)
        AlunoToolStripMenuItem.ForeColor = Color.MidnightBlue
        AlunoToolStripMenuItem.Name = "AlunoToolStripMenuItem"
        AlunoToolStripMenuItem.Size = New Size(51, 20)
        AlunoToolStripMenuItem.Text = "Aluno"
        ' 
        ' ProfessorToolStripMenuItem
        ' 
        ProfessorToolStripMenuItem.Font = New Font("Tahoma", 9.75F, FontStyle.Regular, GraphicsUnit.Point)
        ProfessorToolStripMenuItem.ForeColor = Color.MediumBlue
        ProfessorToolStripMenuItem.Name = "ProfessorToolStripMenuItem"
        ProfessorToolStripMenuItem.Size = New Size(73, 20)
        ProfessorToolStripMenuItem.Text = "Professor"
        ' 
        ' SairToolStripMenuItem
        ' 
        SairToolStripMenuItem.Font = New Font("Tahoma", 9.75F, FontStyle.Regular, GraphicsUnit.Point)
        SairToolStripMenuItem.ForeColor = Color.Red
        SairToolStripMenuItem.Name = "SairToolStripMenuItem"
        SairToolStripMenuItem.Size = New Size(42, 20)
        SairToolStripMenuItem.Text = "Sair"
        ' 
        ' Label4
        ' 
        Label4.AutoSize = True
        Label4.Font = New Font("Tahoma", 12F, FontStyle.Regular, GraphicsUnit.Point)
        Label4.ForeColor = Color.MidnightBlue
        Label4.Location = New Point(24, 55)
        Label4.Name = "Label4"
        Label4.Size = New Size(103, 19)
        Label4.TabIndex = 38
        Label4.Text = "ID professor:"
        ' 
        ' Label3
        ' 
        Label3.AutoSize = True
        Label3.Font = New Font("Tahoma", 12F, FontStyle.Regular, GraphicsUnit.Point)
        Label3.ForeColor = Color.MidnightBlue
        Label3.Location = New Point(247, 177)
        Label3.Name = "Label3"
        Label3.Size = New Size(129, 19)
        Label3.TabIndex = 37
        Label3.Text = "Senha professor:"
        ' 
        ' Label2
        ' 
        Label2.AutoSize = True
        Label2.Font = New Font("Tahoma", 12F, FontStyle.Regular, GraphicsUnit.Point)
        Label2.ForeColor = Color.MidnightBlue
        Label2.Location = New Point(246, 112)
        Label2.Name = "Label2"
        Label2.Size = New Size(140, 19)
        Label2.TabIndex = 36
        Label2.Text = "Usuário professor:"
        ' 
        ' txt_id_aluno
        ' 
        txt_id_aluno.BackColor = Color.WhiteSmoke
        txt_id_aluno.Location = New Point(24, 73)
        txt_id_aluno.Name = "txt_id_aluno"
        txt_id_aluno.Size = New Size(184, 23)
        txt_id_aluno.TabIndex = 0
        ' 
        ' txt_senha_aluno
        ' 
        txt_senha_aluno.BackColor = Color.WhiteSmoke
        txt_senha_aluno.Location = New Point(247, 199)
        txt_senha_aluno.Name = "txt_senha_aluno"
        txt_senha_aluno.Size = New Size(184, 23)
        txt_senha_aluno.TabIndex = 34
        ' 
        ' txt_usuario_aluno
        ' 
        txt_usuario_aluno.BackColor = Color.WhiteSmoke
        txt_usuario_aluno.Location = New Point(246, 134)
        txt_usuario_aluno.Name = "txt_usuario_aluno"
        txt_usuario_aluno.Size = New Size(184, 23)
        txt_usuario_aluno.TabIndex = 33
        ' 
        ' txt_nome_aluno
        ' 
        txt_nome_aluno.BackColor = Color.WhiteSmoke
        txt_nome_aluno.Location = New Point(246, 77)
        txt_nome_aluno.Name = "txt_nome_aluno"
        txt_nome_aluno.Size = New Size(184, 23)
        txt_nome_aluno.TabIndex = 32
        ' 
        ' Label1
        ' 
        Label1.AutoSize = True
        Label1.Font = New Font("Tahoma", 12F, FontStyle.Regular, GraphicsUnit.Point)
        Label1.ForeColor = Color.MidnightBlue
        Label1.Location = New Point(246, 55)
        Label1.Name = "Label1"
        Label1.Size = New Size(128, 19)
        Label1.TabIndex = 31
        Label1.Text = "Nome professor:"
        ' 
        ' btn_limpar
        ' 
        btn_limpar.Cursor = Cursors.Hand
        btn_limpar.Image = CType(resources.GetObject("btn_limpar.Image"), Image)
        btn_limpar.Location = New Point(382, 352)
        btn_limpar.Name = "btn_limpar"
        btn_limpar.Size = New Size(152, 39)
        btn_limpar.TabIndex = 46
        btn_limpar.TabStop = False
        ' 
        ' btn_inativar
        ' 
        btn_inativar.Cursor = Cursors.Hand
        btn_inativar.Image = CType(resources.GetObject("btn_inativar.Image"), Image)
        btn_inativar.Location = New Point(572, 353)
        btn_inativar.Name = "btn_inativar"
        btn_inativar.Size = New Size(152, 38)
        btn_inativar.TabIndex = 45
        btn_inativar.TabStop = False
        ' 
        ' btn_atualizar
        ' 
        btn_atualizar.Cursor = Cursors.Hand
        btn_atualizar.Image = CType(resources.GetObject("btn_atualizar.Image"), Image)
        btn_atualizar.Location = New Point(572, 291)
        btn_atualizar.Name = "btn_atualizar"
        btn_atualizar.Size = New Size(152, 39)
        btn_atualizar.TabIndex = 44
        btn_atualizar.TabStop = False
        ' 
        ' btn_adicionar
        ' 
        btn_adicionar.Cursor = Cursors.Hand
        btn_adicionar.Image = CType(resources.GetObject("btn_adicionar.Image"), Image)
        btn_adicionar.Location = New Point(382, 291)
        btn_adicionar.Name = "btn_adicionar"
        btn_adicionar.Size = New Size(152, 38)
        btn_adicionar.TabIndex = 43
        btn_adicionar.TabStop = False
        ' 
        ' btn_procurar
        ' 
        btn_procurar.Cursor = Cursors.Hand
        btn_procurar.Image = CType(resources.GetObject("btn_procurar.Image"), Image)
        btn_procurar.Location = New Point(39, 102)
        btn_procurar.Name = "btn_procurar"
        btn_procurar.Size = New Size(152, 40)
        btn_procurar.TabIndex = 47
        btn_procurar.TabStop = False
        ' 
        ' PictureBox2
        ' 
        PictureBox2.Image = CType(resources.GetObject("PictureBox2.Image"), Image)
        PictureBox2.Location = New Point(0, 242)
        PictureBox2.Name = "PictureBox2"
        PictureBox2.Size = New Size(303, 216)
        PictureBox2.TabIndex = 49
        PictureBox2.TabStop = False
        ' 
        ' PictureBox1
        ' 
        PictureBox1.Image = CType(resources.GetObject("PictureBox1.Image"), Image)
        PictureBox1.Location = New Point(508, 0)
        PictureBox1.Name = "PictureBox1"
        PictureBox1.Size = New Size(292, 244)
        PictureBox1.TabIndex = 50
        PictureBox1.TabStop = False
        ' 
        ' Label5
        ' 
        Label5.AutoSize = True
        Label5.Font = New Font("Tahoma", 12F, FontStyle.Regular, GraphicsUnit.Point)
        Label5.ForeColor = Color.MidnightBlue
        Label5.Location = New Point(79, 145)
        Label5.Name = "Label5"
        Label5.Size = New Size(57, 19)
        Label5.TabIndex = 51
        Label5.Text = "Ativo :"
        ' 
        ' lbl_ativo
        ' 
        lbl_ativo.BorderStyle = BorderStyle.Fixed3D
        lbl_ativo.Location = New Point(59, 173)
        lbl_ativo.Name = "lbl_ativo"
        lbl_ativo.Size = New Size(100, 23)
        lbl_ativo.TabIndex = 52
        ' 
        ' btn_ativar
        ' 
        btn_ativar.Cursor = Cursors.Hand
        btn_ativar.Image = CType(resources.GetObject("btn_ativar.Image"), Image)
        btn_ativar.Location = New Point(39, 206)
        btn_ativar.Name = "btn_ativar"
        btn_ativar.Size = New Size(152, 38)
        btn_ativar.TabIndex = 53
        btn_ativar.TabStop = False
        ' 
        ' Form3
        ' 
        AutoScaleDimensions = New SizeF(7F, 15F)
        AutoScaleMode = AutoScaleMode.Font
        BackColor = Color.WhiteSmoke
        ClientSize = New Size(800, 450)
        Controls.Add(btn_ativar)
        Controls.Add(lbl_ativo)
        Controls.Add(Label5)
        Controls.Add(btn_procurar)
        Controls.Add(btn_limpar)
        Controls.Add(btn_inativar)
        Controls.Add(btn_atualizar)
        Controls.Add(btn_adicionar)
        Controls.Add(PictureBox1)
        Controls.Add(Label4)
        Controls.Add(Label3)
        Controls.Add(Label2)
        Controls.Add(txt_id_aluno)
        Controls.Add(txt_senha_aluno)
        Controls.Add(txt_usuario_aluno)
        Controls.Add(txt_nome_aluno)
        Controls.Add(Label1)
        Controls.Add(MenuStrip1)
        Controls.Add(PictureBox2)
        FormBorderStyle = FormBorderStyle.None
        Icon = CType(resources.GetObject("$this.Icon"), Icon)
        Name = "Form3"
        Text = "School Points"
        MenuStrip1.ResumeLayout(False)
        MenuStrip1.PerformLayout()
        CType(btn_limpar, ComponentModel.ISupportInitialize).EndInit()
        CType(btn_inativar, ComponentModel.ISupportInitialize).EndInit()
        CType(btn_atualizar, ComponentModel.ISupportInitialize).EndInit()
        CType(btn_adicionar, ComponentModel.ISupportInitialize).EndInit()
        CType(btn_procurar, ComponentModel.ISupportInitialize).EndInit()
        CType(PictureBox2, ComponentModel.ISupportInitialize).EndInit()
        CType(PictureBox1, ComponentModel.ISupportInitialize).EndInit()
        CType(btn_ativar, ComponentModel.ISupportInitialize).EndInit()
        ResumeLayout(False)
        PerformLayout()
    End Sub

    Friend WithEvents MenuStrip1 As MenuStrip
    Friend WithEvents AlunoToolStripMenuItem As ToolStripMenuItem
    Friend WithEvents ProfessorToolStripMenuItem As ToolStripMenuItem
    Friend WithEvents Label4 As Label
    Friend WithEvents Label3 As Label
    Friend WithEvents Label2 As Label
    Friend WithEvents txt_id_aluno As TextBox
    Friend WithEvents txt_senha_aluno As TextBox
    Friend WithEvents txt_usuario_aluno As TextBox
    Friend WithEvents txt_nome_aluno As TextBox
    Friend WithEvents Label1 As Label
    Friend WithEvents SairToolStripMenuItem As ToolStripMenuItem
    Friend WithEvents btn_limpar As PictureBox
    Friend WithEvents btn_inativar As PictureBox
    Friend WithEvents btn_atualizar As PictureBox
    Friend WithEvents btn_adicionar As PictureBox
    Friend WithEvents btn_procurar As PictureBox
    Friend WithEvents PictureBox2 As PictureBox
    Friend WithEvents PictureBox1 As PictureBox
    Friend WithEvents Label5 As Label
    Friend WithEvents lbl_ativo As Label
    Friend WithEvents btn_ativar As PictureBox
End Class
