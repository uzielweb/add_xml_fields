# ADD XML FIELDS JOOMLA PLUGIN

### -- In English (em inglês) --

###### ADVISE - This plugin add and/or change xml fields. This plugin do not OVERRIDE completely the xml form from models. I Will make this function in the next 1.0.6 version (I hope). If you need override the entire XML form (to change and remove or hide fields) I suggest ICUE FORM XML OVERRIDE (icueproject.com/products/override-xml-forms)

#### A Joomla Plugin to add xml form fields to any site module, site component or administrator component

How to use:

- Create your modules or component overrides in the html folder of your template according to the Joomla official documentation

- Create the xml file via ftp with the desired name according the prescription in readme file instructions bellow (exists a form example.xml to refference inside of the plugin folder)

- for components you can choose between "ADMINISTRATOR or SITE template override" and "ADMINISTRATOR or SITE system templates" (in this case: for admin system create administrator/template/system/forms/com_componentname/your.xml and for site system create template/system/forms/com_componentname/your.xml). If you choose "ADMINISTRATOR or SITE template override": for admin override template create administrator/template/your_default_template/html/com_componentname/forms/your.xml and for site template override create template/your_default_template/html/com_componentname/forms/your.xml 

- Install and enable the plugin

- Within the plugin settings, enter the names of the modules or components and their respective xml files (without the xml extension) separated by commas. Ex: mod_articles_latest, mod_articles_category and xmlname1, xmlname2. Eg2:com_content,com_category and gallery.xml,portfolio.xml 


- Create your module and save it. After saving you will be able to see the custom fields. This step may be before others. The important thing is to save it. Only after you can see the custom fields working. In the next version I will eliminate this need to save before, I promess.

You can see or download a smart override example for Mod Articles Latest in this link: https://github.com/uzielweb/mod_articles_latest_override

### Standard Form Field Types for Joomla

See the link: https://docs.joomla.org/Form_field

### -- Em Português (in portuguese) --
###### AVISO - Este plugin adiciona e/ou muda campos xml. Este plugin não sobrescreve completamente o formulário xml de models. Eu farei essa função na próxima versão 1.0.6 (espero). Se você precisar substituir todo o formulário XML (para alterar e remover ou ocultar campos), sugiro ICUE FORM XML OVERRIDE (icueproject.com/products/override-xml-forms)

#### Um Plugin para Joomla para adicionar campos de formulários xml a qualquer módulo do site e componentes do site e do administrador

Modo de utilização:

- deves criar o substituto (override) do teu módulo ou componente na pasta html do teu template conforme a documentação do Joomla! 

- deves criar o arquivo xml via ftp com o nome desejado conforme prescrição do arquivo leia-me nas descrições abaixo (existe um formulário example.xml para referência dentro da pasta do plugin). 

- para os componentes podes escolher entre "Substituição do tema do ADMINISTRADOR ou SITE" e "Tema de sistema do ADMINISTRADOR ou SITE"
- para tema de sistema do administrador deves criar o xml em administrator/template/system/forms/com_nomedocomponente/teu.xml
- para tema de sistema do site deves criar o xml em template/system/forms/com_nomedocomponente/teu.xml
- para substituição do tema do ADMINISTRADOR deves criar o xml em administrator/templates/teu_tema_padrão/html/com_nome_do_componente/forms/your.xml 
- para substituição do tema do SITE deves criar em templates/teu_tema_padrão/html/com_nome_do_componente/forms/teu.xml

- Instala e habilita o plugin

- Dentro das configurações do plugin digita os nomes dos módulos ou componentes e seus respectivos arquivos xml (sem a extensão xml) separados por vírgulas. Ex.: mod_articles_latest,mod_articles_category e nomedoxml1, nomedoxml2. Ex2:com_content,com_category e gallery.xml,portfolio.xml 

- Cria teu módulo e salva-o. Após salvar poderás ver os campos personalizados. Este passo pode ser antes dos outros. O Importante é salvar para, só depois, poder ver os campos personalizados funcionando. Numa próxima versão eliminarei essa necessidade de salvar antes, prometo.

Você pode ver ou baixar um exemplo de substituição inteligente para artigos do Módulo Últimos Artigos neste link: https://github.com/uzielweb/mod_articles_latest_override

### Tipos de Campo Padrões do Joomla

Acesse o seguinte endereço: https://docs.joomla.org/Form_field

