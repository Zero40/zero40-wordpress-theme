<div class="row">
 <div class="col-md-6">
  <label class="pergunta" for="startup">Nome da Startup</label>
  [text* startup]
 </div>
 <div class="col-md-6">
  <label class="pergunta" for="founder">Nome do(a) Founder</label>
  [text* founder]
 </div>

 <div class="col-md-6">
  <label class="pergunta" for="useremail">Email</label>
  [email* useremail]
 </div>
 <div class="col-md-6">
  <label class="pergunta" for="celular">Celular</label>
  [text* celular]
 </div>

 <div class="col-md-6">
  <label class="pergunta" for="website">Site</label>
  [url* website]
 </div>
 <div class="col-md-6">
  <label class="pergunta" for="cidade">Cidade</label>
  [text* cidade]
 </div>
</div>

<label class="pergunta" for="descricao">Descrição da Startup</label>
<small>Esta descrição ficará visível no site do Zero40, após aprovação.Trata-se de um pequeno parágrafo que resuma seu modelo de negócio.</small>
[textarea* descricao]


<label class="pergunta" for="fundacao">Data de fundação da startup</label>
[date* fundacao]


<label class="pergunta" for="genero">Qual o gênero de quem fundou a startup</label>
[radio genero use_label_element default:1 "Feminino" "Masculino" "Mulher transgênero" "Homem transgênero" "Não binário" "Mais de um fundador e a maioria é feminina" "Mais de um fundador e a maioria é masculina" "Mais de um fundador e a proporção entre os gêneros é igual"]


<label class="pergunta" for="idade">Qual a idade de quem fundou ou a média dos que fundaram a startup?</label>
[radio idade use_label_element default:1 "Menos de 20 anos" "De 20 a 25 anos" "De 26 a 30 anos" "De 31 a 35 anos" "De 35 a 40 anos" "De 41 a 45 anos" "46 anos ou mais"]


<label class="pergunta" for="momento">Qual o momento atual da sua startup</label>
[radio momento id:momento use_label_element default:1 "Curiosidade (busca de informações, não existe ideia ou negócio formatado)" "Ideação (em desenvolvimento da ideia, estudo do mercado, identificação de oportunidades, nichos e soluções)" "Validação (em fase de validação do protótipo - MVP - e dos primeiros clientes)" "Operação (protótipos validados, modelo de negócio definido, conhecimento do mercado)" "Tração (Tração (métricas e objetivos definidos, busca de parceiras para crescimento)" "Escala (crescimento médio anual acima de 20% ao ano, em termos de empregados)"]


<label class="pergunta" for="publico">Qual o principal público-alvo da sua Startup</label>
[radio publico use_label_element default:1 "Empresas (B2B)" "Empresas e consumidor final (B2B2C)" "Empresas e Consumidor final (B2C)" "Consumidor Final e Consumidor final (P2P)" "Governo (B2G)" "Startups (B2S)"]


<label class="pergunta" for="area">Qual a área de atuação da sua empresa?</label>
[checkbox* area use_label_element default:1 "Advertising" "Agronegócios (Agtech)" "Alimentação (Foodtech)" "Setor Automotivo" "Big Data" "Biotecnologia" "Casa e Família" "Cloud Computing" "Comunicação e Marketing" "Construção Civil (Construtech)" "Desenvolvimento de Software" "Direito (Lawtech)" "E-commerce / Marketplace" "Economia Circular" "Educação (Edtech)" "Energia" "Entretenimento" "Esportes" "Eventos" "Finanças (Fintech)" "Games" "Gestão" "Gestão de Resíduos" "Governo" "Imobiliário" "Impacto Social e Ambiental" "Logística e Supply Chain" "Meio ambiente e Sustentabilidade" "Mineração" "Moda e beleza" "Óleo e Gás" "Pets" "Produtos de consumo" "Recursos Humanos e Recrutamento" "Robótica" "Saúde e Bem-estar (HealthTech e Life Science)" "Segurança e defesa (Cybersecurity)" "Seguros (Insurance)" "Smart Cities" "TIC e Telecom" "Transporte e Mobilidade urbana" "Turismo" "Venda por varejo / atacado (Retail)" "Vendas"]


<label class="pergunta" for="inovacao">Qual é o tipo de inovação que sua startup apresenta?</label>
[checkbox* inovacao use_label_element default:1 "Produto ou serviço novo ou significativamente melhorado" "Processo novo ou significativamente melhorado" "Estratégias de marketing novas ou significativamente melhoradas" "Estruturas organizacionais e Organização do negócio nova ou significativamente melhorada" "Modelo de Negócio novo ou significativamente melhorado (inovação em como a empresa cria, gera e entrega valor)"]


<label class="pergunta" for="modelo">Qual é o principal modelo de negócio da sua Startup</label>
[radio modelo use_label_element default:1 "SaaS (software disponibilizado a usuários através de assinatura. Exemplos: SalesForce)" "Marketplace (quando dois ou mais usuários realizam uma transação. Ex. Mercado Livre)" "Consumer (app gratuito ou de baixo custo entregando valor ou engajamento aos usuários)" "Hardware (cobrança pelo hardware e/ou software do hardware e/ou serviços agregados)" "Venda de dados (serviços de coleta, tratamento, formatação e análise de dados)" "API Application Programming Interface (clientes que assinam ou pagam pelo uso de uma API)" "Licenciamento (licenciamento de propriedades intelectuais que incluem patentes, marcas comerciais, segredos comerciais)" "Clube de Assinatura recorrente (quando algum serviço é disponibilizado através de um plano de assinatura)" "Venda direta (venda de produtos online ou presencial gerando receita através de margem sobre produtos vendidos)" "Taxa sobre transações (clientes pagam uma taxa em cima da operação de um serviço)"]


<label class="pergunta" for="tamanho">Qual o tamanho atual da sua equipe (incluindo os sócios)</label>
[radio tamanho use_label_element default:1 "1-5" "5-10" "11-20" "21-40" "41-100"]


<label class="pergunta" for="jafoi">Sua startup já foi:</label>
[radio jafoi use_label_element default:1 "Pré-acelerada" "Acelerada" "Incubada" "Nenhuma das opções"]


<label class="pergunta" for="investimento">Você já recebeu investimento?</label>
[radio investimento use_label_element default:1 "Sim" "Não"]


<label class="pergunta" for="faturamento">Qual a faixa de faturamento anual da sua startup em 2019?</label>
[radio faturamento use_label_element default:1 "Sem faturamento" "Abaixo de R$10 mil" "R$10 mil a R$30 mil" "R$30 mil a R$50 mil" "R$50 mil a R$250 mil" "R$250 mil a R$500 mil" "R$ 500 mil a 1 milhão" "R$ 1 a 2,5 milhões" "R$ 2,5 a 5 milhões" "Acima de 5 milhões"]

<label class="pergunta" for="logo">Adicione a logomarca da sua empresa</label>
<div class="file-row">
[file* logo limit:10mb filetypes:png|jpg|jpeg]
</div>

[submit id:btn-cadastrar "Cadastrar"]
<small>Site protegido por reCAPTCHA. Consulte a <a target="_blank" href="https://policies.google.com/privacy">Política de Privacidade</a> e os <a target="_blank" href="https://policies.google.com/terms">Termos de Serviços</a> do Google.</small>