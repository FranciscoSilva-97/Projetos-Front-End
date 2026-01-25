<?php
// Sistema Completo de Oficina Mecânica - Versão Corrigida e Completa

class OficinaMecanica {
    private $clientes = [];
    private $veiculos = [];
    private $servicos = [];
    private $pecas = [];
    private $mecanicos = [];
    private $ordens_servico = [];
    private $agendamentos = [];
    private $fornecedores = [];
    private $current_id = 1;

    public function __construct() {
        $this->inicializarDados();
    }

    private function inicializarDados() {
        // Dados iniciais de exemplo
        $this->clientes = [
            [
                'id' => 1,
                'nome' => 'João Silva',
                'email' => 'joao@email.com',
                'telefone' => '(11) 9999-8888',
                'endereco' => 'Rua A, 123 - São Paulo/SP',
                'cpf' => '123.456.789-00',
                'data_cadastro' => '2024-01-15',
                'tipo' => 'regular'
            ],
            [
                'id' => 2,
                'nome' => 'Maria Santos',
                'email' => 'maria@email.com',
                'telefone' => '(11) 7777-6666',
                'endereco' => 'Av. B, 456 - São Paulo/SP',
                'cpf' => '987.654.321-00',
                'data_cadastro' => '2024-01-20',
                'tipo' => 'premium'
            ]
        ];

        $this->veiculos = [
            [
                'id' => 1,
                'cliente_id' => 1,
                'marca' => 'Volkswagen',
                'modelo' => 'Gol',
                'ano' => 2020,
                'placa' => 'ABC-1234',
                'cor' => 'Preto',
                'km_atual' => 45000,
                'chassi' => '9BWZZZ377VT004251'
            ],
            [
                'id' => 2,
                'cliente_id' => 2,
                'marca' => 'Fiat',
                'modelo' => 'Uno',
                'ano' => 2019,
                'placa' => 'DEF-5678',
                'cor' => 'Branco',
                'km_atual' => 38000
            ]
        ];

        $this->servicos = [
            [
                'id' => 1,
                'nome' => 'Troca de Óleo',
                'descricao' => 'Troca de óleo do motor e filtro',
                'preco' => 150.00,
                'tempo_estimado' => '01:00',
                'categoria' => 'Manutenção'
            ],
            [
                'id' => 2,
                'nome' => 'Alinhamento e Balanceamento',
                'descricao' => 'Alinhamento da direção e balanceamento das rodas',
                'preco' => 120.00,
                'tempo_estimado' => '01:30',
                'categoria' => 'Suspensão'
            ]
        ];

        $this->pecas = [
            [
                'id' => 1,
                'nome' => 'Filtro de Óleo',
                'descricao' => 'Filtro de óleo original',
                'preco_compra' => 15.00,
                'preco_venda' => 25.00,
                'estoque' => 50,
                'estoque_minimo' => 10,
                'categoria' => 'Filtros',
                'fornecedor_id' => 1
            ],
            [
                'id' => 2,
                'nome' => 'Pastilha de Freio',
                'descricao' => 'Pastilha de freio dianteira',
                'preco_compra' => 80.00,
                'preco_venda' => 120.00,
                'estoque' => 5,
                'estoque_minimo' => 10,
                'categoria' => 'Freios',
                'fornecedor_id' => 1
            ]
        ];

        $this->mecanicos = [
            [
                'id' => 1,
                'nome' => 'Carlos Oliveira',
                'especialidade' => 'Motor e Transmissão',
                'telefone' => '(11) 8888-7777',
                'email' => 'carlos@oficina.com',
                'ativo' => true,
                'salario' => 3500.00
            ],
            [
                'id' => 2,
                'nome' => 'Ana Costa',
                'especialidade' => 'Suspensão e Freios',
                'telefone' => '(11) 6666-5555',
                'email' => 'ana@oficina.com',
                'ativo' => true,
                'salario' => 3200.00
            ]
        ];

        $this->fornecedores = [
            [
                'id' => 1,
                'nome' => 'Auto Peças São Paulo',
                'contato' => 'Fernando',
                'telefone' => '(11) 3333-2222',
                'email' => 'vendas@autopecassp.com.br',
                'endereco' => 'Rua das Peças, 100 - São Paulo/SP'
            ]
        ];

        $this->ordens_servico = [
            [
                'id' => 1,
                'veiculo_id' => 1,
                'data_abertura' => '2024-01-25',
                'data_conclusao' => '2024-01-26',
                'status' => 'concluida',
                'observacoes' => 'Troca de óleo completa',
                'valor_total' => 175.00,
                'mecanico_id' => 1
            ]
        ];

        $this->agendamentos = [
            [
                'id' => 1,
                'veiculo_id' => 1,
                'data_agendamento' => date('Y-m-d 09:00:00', strtotime('+1 day')),
                'servico_solicitado' => 'Revisão periódica',
                'status' => 'agendado',
                'observacoes' => 'Cliente preferencial'
            ]
        ];

        $this->current_id = 10;
    }

    // Métodos para Clientes
    public function getClientes() {
        return $this->clientes;
    }

    public function getClienteById($id) {
        foreach ($this->clientes as $cliente) {
            if ($cliente['id'] == $id) {
                return $cliente;
            }
        }
        return null;
    }

    public function addCliente($dados) {
        $dados['id'] = $this->current_id++;
        $dados['data_cadastro'] = date('Y-m-d');
        $this->clientes[] = $dados;
        return $dados['id'];
    }

    public function updateCliente($id, $dados) {
        foreach ($this->clientes as &$cliente) {
            if ($cliente['id'] == $id) {
                $cliente = array_merge($cliente, $dados);
                return true;
            }
        }
        return false;
    }

    public function deleteCliente($id) {
        foreach ($this->clientes as $key => $cliente) {
            if ($cliente['id'] == $id) {
                unset($this->clientes[$key]);
                $this->clientes = array_values($this->clientes);
                return true;
            }
        }
        return false;
    }

    // Métodos para Veículos
    public function getVeiculos() {
        $veiculos_com_cliente = [];
        foreach ($this->veiculos as $veiculo) {
            $cliente = $this->getClienteById($veiculo['cliente_id']);
            $veiculo['cliente_nome'] = $cliente ? $cliente['nome'] : 'N/A';
            $veiculos_com_cliente[] = $veiculo;
        }
        return $veiculos_com_cliente;
    }

    public function getVeiculoById($id) {
        foreach ($this->veiculos as $veiculo) {
            if ($veiculo['id'] == $id) {
                return $veiculo;
            }
        }
        return null;
    }

    public function addVeiculo($dados) {
        $dados['id'] = $this->current_id++;
        $this->veiculos[] = $dados;
        return $dados['id'];
    }

    public function updateVeiculo($id, $dados) {
        foreach ($this->veiculos as &$veiculo) {
            if ($veiculo['id'] == $id) {
                $veiculo = array_merge($veiculo, $dados);
                return true;
            }
        }
        return false;
    }

    public function deleteVeiculo($id) {
        foreach ($this->veiculos as $key => $veiculo) {
            if ($veiculo['id'] == $id) {
                unset($this->veiculos[$key]);
                $this->veiculos = array_values($this->veiculos);
                return true;
            }
        }
        return false;
    }

    // Métodos para Serviços
    public function getServicos() {
        return $this->servicos;
    }

    public function getServicoById($id) {
        foreach ($this->servicos as $servico) {
            if ($servico['id'] == $id) {
                return $servico;
            }
        }
        return null;
    }

    public function addServico($dados) {
        $dados['id'] = $this->current_id++;
        $this->servicos[] = $dados;
        return $dados['id'];
    }

    public function updateServico($id, $dados) {
        foreach ($this->servicos as &$servico) {
            if ($servico['id'] == $id) {
                $servico = array_merge($servico, $dados);
                return true;
            }
        }
        return false;
    }

    public function deleteServico($id) {
        foreach ($this->servicos as $key => $servico) {
            if ($servico['id'] == $id) {
                unset($this->servicos[$key]);
                $this->servicos = array_values($this->servicos);
                return true;
            }
        }
        return false;
    }

    // Métodos para Peças
    public function getPecas() {
        return $this->pecas;
    }

    public function getPecaById($id) {
        foreach ($this->pecas as $peca) {
            if ($peca['id'] == $id) {
                return $peca;
            }
        }
        return null;
    }

    public function addPeca($dados) {
        $dados['id'] = $this->current_id++;
        $this->pecas[] = $dados;
        return $dados['id'];
    }

    public function updatePeca($id, $dados) {
        foreach ($this->pecas as &$peca) {
            if ($peca['id'] == $id) {
                $peca = array_merge($peca, $dados);
                return true;
            }
        }
        return false;
    }

    public function deletePeca($id) {
        foreach ($this->pecas as $key => $peca) {
            if ($peca['id'] == $id) {
                unset($this->pecas[$key]);
                $this->pecas = array_values($this->pecas);
                return true;
            }
        }
        return false;
    }

    // Métodos para Mecânicos
    public function getMecanicos() {
        return $this->mecanicos;
    }

    public function getMecanicoById($id) {
        foreach ($this->mecanicos as $mecanico) {
            if ($mecanico['id'] == $id) {
                return $mecanico;
            }
        }
        return null;
    }

    public function addMecanico($dados) {
        $dados['id'] = $this->current_id++;
        $this->mecanicos[] = $dados;
        return $dados['id'];
    }

    public function updateMecanico($id, $dados) {
        foreach ($this->mecanicos as &$mecanico) {
            if ($mecanico['id'] == $id) {
                $mecanico = array_merge($mecanico, $dados);
                return true;
            }
        }
        return false;
    }

    public function deleteMecanico($id) {
        foreach ($this->mecanicos as $key => $mecanico) {
            if ($mecanico['id'] == $id) {
                unset($this->mecanicos[$key]);
                $this->mecanicos = array_values($this->mecanicos);
                return true;
            }
        }
        return false;
    }

    // Gestão de Fornecedores
    public function getFornecedores() {
        return $this->fornecedores;
    }

    public function addFornecedor($dados) {
        $dados['id'] = $this->current_id++;
        $this->fornecedores[] = $dados;
        return $dados['id'];
    }

    // Gestão de Ordens de Serviço
    public function getOrdensServico() {
        $ordens_completa = [];
        foreach ($this->ordens_servico as $ordem) {
            $veiculo = $this->getVeiculoById($ordem['veiculo_id']);
            $cliente = $veiculo ? $this->getClienteById($veiculo['cliente_id']) : null;
            $mecanico = $this->getMecanicoById($ordem['mecanico_id']);
            
            $ordens_completa[] = array_merge($ordem, [
                'cliente_nome' => $cliente ? $cliente['nome'] : 'N/A',
                'veiculo_info' => $veiculo ? "{$veiculo['marca']} {$veiculo['modelo']} - {$veiculo['placa']}" : 'N/A',
                'mecanico_nome' => $mecanico ? $mecanico['nome'] : 'N/A'
            ]);
        }
        return $ordens_completa;
    }

    public function addOrdemServico($dados) {
        $dados['id'] = $this->current_id++;
        $dados['data_abertura'] = date('Y-m-d');
        $this->ordens_servico[] = $dados;
        return $dados['id'];
    }

    // Gestão de Agendamentos
    public function getAgendamentos() {
        $agendamentos_completo = [];
        foreach ($this->agendamentos as $agendamento) {
            $veiculo = $this->getVeiculoById($agendamento['veiculo_id']);
            $cliente = $veiculo ? $this->getClienteById($veiculo['cliente_id']) : null;
            
            $agendamentos_completo[] = array_merge($agendamento, [
                'cliente_nome' => $cliente ? $cliente['nome'] : 'N/A',
                'veiculo_info' => $veiculo ? "{$veiculo['marca']} {$veiculo['modelo']} - {$veiculo['placa']}" : 'N/A'
            ]);
        }
        return $agendamentos_completo;
    }

    public function addAgendamento($dados) {
        $dados['id'] = $this->current_id++;
        $this->agendamentos[] = $dados;
        return $dados['id'];
    }

    // Métodos para Dashboard
    public function getEstatisticas() {
        $ordens_mes = array_filter($this->ordens_servico, function($ordem) {
            return date('Y-m', strtotime($ordem['data_abertura'])) == date('Y-m');
        });

        $receita_mensal = array_sum(array_column($ordens_mes, 'valor_total'));
        $clientes_novos_mes = array_filter($this->clientes, function($cliente) {
            return date('Y-m', strtotime($cliente['data_cadastro'])) == date('Y-m');
        });

        return [
            'total_clientes' => count($this->clientes),
            'total_veiculos' => count($this->veiculos),
            'total_servicos' => count($this->servicos),
            'total_pecas' => count($this->pecas),
            'total_mecanicos' => count($this->mecanicos),
            'receita_mensal' => $receita_mensal,
            'clientes_novos_mes' => count($clientes_novos_mes),
            'ordens_mes' => count($ordens_mes),
            'pecas_estoque_baixo' => count(array_filter($this->pecas, function($peca) {
                return $peca['estoque'] <= $peca['estoque_minimo'];
            })),
            'agendamentos_hoje' => count(array_filter($this->agendamentos, function($agendamento) {
                return date('Y-m-d', strtotime($agendamento['data_agendamento'])) == date('Y-m-d');
            }))
        ];
    }

    // Alertas e Notificações
    public function getAlertas() {
        $alertas = [];

        // Alertas de estoque baixo
        foreach ($this->pecas as $peca) {
            if ($peca['estoque'] <= $peca['estoque_minimo']) {
                $alertas[] = [
                    'tipo' => 'estoque',
                    'mensagem' => "Estoque baixo: {$peca['nome']} - {$peca['estoque']} unidades",
                    'nivel' => $peca['estoque'] == 0 ? 'critico' : 'alerta'
                ];
            }
        }

        // Alertas de agendamentos hoje
        $hoje = date('Y-m-d');
        $agendamentos_hoje = array_filter($this->agendamentos, function($agendamento) use ($hoje) {
            return date('Y-m-d', strtotime($agendamento['data_agendamento'])) == $hoje;
        });

        foreach ($agendamentos_hoje as $agendamento) {
            $alertas[] = [
                'tipo' => 'agendamento',
                'mensagem' => "Agendamento hoje às " . date('H:i', strtotime($agendamento['data_agendamento'])),
                'nivel' => 'info'
            ];
        }

        return $alertas;
    }

    // Busca Integrada
    public function buscar($termo) {
        $resultados = [];

        // Buscar em clientes
        foreach ($this->clientes as $cliente) {
            if (stripos($cliente['nome'], $termo) !== false || 
                stripos($cliente['telefone'], $termo) !== false ||
                stripos($cliente['email'], $termo) !== false) {
                $resultados['clientes'][] = $cliente;
            }
        }

        // Buscar em veículos
        foreach ($this->veiculos as $veiculo) {
            if (stripos($veiculo['placa'], $termo) !== false || 
                stripos($veiculo['marca'], $termo) !== false ||
                stripos($veiculo['modelo'], $termo) !== false) {
                $resultados['veiculos'][] = $veiculo;
            }
        }

        return $resultados;
    }
}

// Inicializar o sistema
$oficina = new OficinaMecanica();

// Processar formulários
if ($_POST) {
    $page = $_GET['page'] ?? 'dashboard';
    $action = $_GET['action'] ?? 'index';

    switch ($page) {
        case 'clientes':
            if ($action == 'create') {
                $id = $oficina->addCliente([
                    'nome' => $_POST['nome'],
                    'email' => $_POST['email'],
                    'telefone' => $_POST['telefone'],
                    'endereco' => $_POST['endereco'],
                    'cpf' => $_POST['cpf'],
                    'tipo' => $_POST['tipo'] ?? 'regular'
                ]);
                header("Location: ?page=clientes&success=1");
                exit;
            } elseif ($action == 'edit') {
                $oficina->updateCliente($_GET['id'], [
                    'nome' => $_POST['nome'],
                    'email' => $_POST['email'],
                    'telefone' => $_POST['telefone'],
                    'endereco' => $_POST['endereco'],
                    'cpf' => $_POST['cpf'],
                    'tipo' => $_POST['tipo'] ?? 'regular'
                ]);
                header("Location: ?page=clientes&success=1");
                exit;
            }
            break;

        case 'veiculos':
            if ($action == 'create') {
                $id = $oficina->addVeiculo([
                    'cliente_id' => $_POST['cliente_id'],
                    'marca' => $_POST['marca'],
                    'modelo' => $_POST['modelo'],
                    'ano' => $_POST['ano'],
                    'placa' => $_POST['placa'],
                    'cor' => $_POST['cor'],
                    'km_atual' => $_POST['km_atual']
                ]);
                header("Location: ?page=veiculos&success=1");
                exit;
            } elseif ($action == 'edit') {
                $oficina->updateVeiculo($_GET['id'], [
                    'cliente_id' => $_POST['cliente_id'],
                    'marca' => $_POST['marca'],
                    'modelo' => $_POST['modelo'],
                    'ano' => $_POST['ano'],
                    'placa' => $_POST['placa'],
                    'cor' => $_POST['cor'],
                    'km_atual' => $_POST['km_atual']
                ]);
                header("Location: ?page=veiculos&success=1");
                exit;
            }
            break;

        case 'servicos':
            if ($action == 'create') {
                $id = $oficina->addServico([
                    'nome' => $_POST['nome'],
                    'descricao' => $_POST['descricao'],
                    'preco' => $_POST['preco'],
                    'tempo_estimado' => $_POST['tempo_estimado'],
                    'categoria' => $_POST['categoria']
                ]);
                header("Location: ?page=servicos&success=1");
                exit;
            } elseif ($action == 'edit') {
                $oficina->updateServico($_GET['id'], [
                    'nome' => $_POST['nome'],
                    'descricao' => $_POST['descricao'],
                    'preco' => $_POST['preco'],
                    'tempo_estimado' => $_POST['tempo_estimado'],
                    'categoria' => $_POST['categoria']
                ]);
                header("Location: ?page=servicos&success=1");
                exit;
            }
            break;

        case 'pecas':
            if ($action == 'create') {
                $id = $oficina->addPeca([
                    'nome' => $_POST['nome'],
                    'descricao' => $_POST['descricao'],
                    'preco_compra' => $_POST['preco_compra'],
                    'preco_venda' => $_POST['preco_venda'],
                    'estoque' => $_POST['estoque'],
                    'estoque_minimo' => $_POST['estoque_minimo'],
                    'categoria' => $_POST['categoria'],
                    'fornecedor_id' => $_POST['fornecedor_id'] ?? 1
                ]);
                header("Location: ?page=pecas&success=1");
                exit;
            } elseif ($action == 'edit') {
                $oficina->updatePeca($_GET['id'], [
                    'nome' => $_POST['nome'],
                    'descricao' => $_POST['descricao'],
                    'preco_compra' => $_POST['preco_compra'],
                    'preco_venda' => $_POST['preco_venda'],
                    'estoque' => $_POST['estoque'],
                    'estoque_minimo' => $_POST['estoque_minimo'],
                    'categoria' => $_POST['categoria'],
                    'fornecedor_id' => $_POST['fornecedor_id'] ?? 1
                ]);
                header("Location: ?page=pecas&success=1");
                exit;
            }
            break;

        case 'mecanicos':
            if ($action == 'create') {
                $id = $oficina->addMecanico([
                    'nome' => $_POST['nome'],
                    'especialidade' => $_POST['especialidade'],
                    'telefone' => $_POST['telefone'],
                    'email' => $_POST['email'],
                    'ativo' => isset($_POST['ativo']),
                    'salario' => $_POST['salario'] ?? 0
                ]);
                header("Location: ?page=mecanicos&success=1");
                exit;
            } elseif ($action == 'edit') {
                $oficina->updateMecanico($_GET['id'], [
                    'nome' => $_POST['nome'],
                    'especialidade' => $_POST['especialidade'],
                    'telefone' => $_POST['telefone'],
                    'email' => $_POST['email'],
                    'ativo' => isset($_POST['ativo']),
                    'salario' => $_POST['salario'] ?? 0
                ]);
                header("Location: ?page=mecanicos&success=1");
                exit;
            }
            break;

        case 'fornecedores':
            if ($action == 'create') {
                $id = $oficina->addFornecedor([
                    'nome' => $_POST['nome'],
                    'contato' => $_POST['contato'],
                    'telefone' => $_POST['telefone'],
                    'email' => $_POST['email'],
                    'endereco' => $_POST['endereco']
                ]);
                header("Location: ?page=fornecedores&success=1");
                exit;
            }
            break;

        case 'ordens':
            if ($action == 'create') {
                $id = $oficina->addOrdemServico([
                    'veiculo_id' => $_POST['veiculo_id'],
                    'status' => $_POST['status'],
                    'observacoes' => $_POST['observacoes'],
                    'valor_total' => $_POST['valor_total'],
                    'mecanico_id' => $_POST['mecanico_id']
                ]);
                header("Location: ?page=ordens&success=1");
                exit;
            }
            break;

        case 'agendamentos':
            if ($action == 'create') {
                $id = $oficina->addAgendamento([
                    'veiculo_id' => $_POST['veiculo_id'],
                    'data_agendamento' => $_POST['data_agendamento'],
                    'servico_solicitado' => $_POST['servico_solicitado'],
                    'status' => $_POST['status'],
                    'observacoes' => $_POST['observacoes']
                ]);
                header("Location: ?page=agendamentos&success=1");
                exit;
            }
            break;
    }
}

// Processar exclusões
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $page = $_GET['page'] ?? '';
    $id = $_GET['id'] ?? 0;

    switch ($page) {
        case 'clientes':
            $oficina->deleteCliente($id);
            header("Location: ?page=clientes&success=1");
            exit;
        case 'veiculos':
            $oficina->deleteVeiculo($id);
            header("Location: ?page=veiculos&success=1");
            exit;
        case 'servicos':
            $oficina->deleteServico($id);
            header("Location: ?page=servicos&success=1");
            exit;
        case 'pecas':
            $oficina->deletePeca($id);
            header("Location: ?page=pecas&success=1");
            exit;
        case 'mecanicos':
            $oficina->deleteMecanico($id);
            header("Location: ?page=mecanicos&success=1");
            exit;
    }
}

// Roteamento
$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Dados para as views
$clientes = $oficina->getClientes();
$veiculos = $oficina->getVeiculos();
$servicos = $oficina->getServicos();
$pecas = $oficina->getPecas();
$mecanicos = $oficina->getMecanicos();
$ordens_servico = $oficina->getOrdensServico();
$agendamentos = $oficina->getAgendamentos();
$fornecedores = $oficina->getFornecedores();
$estatisticas = $oficina->getEstatisticas();
$alertas = $oficina->getAlertas();

// Processar busca
$resultados_busca = [];
if (isset($_GET['buscar']) && !empty($_GET['termo_busca'])) {
    $resultados_busca = $oficina->buscar($_GET['termo_busca']);
}

// Obter item específico para edição
$cliente_edicao = $id && $page == 'clientes' && $action == 'edit' ? $oficina->getClienteById($id) : null;
$veiculo_edicao = $id && $page == 'veiculos' && $action == 'edit' ? $oficina->getVeiculoById($id) : null;
$servico_edicao = $id && $page == 'servicos' && $action == 'edit' ? $oficina->getServicoById($id) : null;
$peca_edicao = $id && $page == 'pecas' && $action == 'edit' ? $oficina->getPecaById($id) : null;
$mecanico_edicao = $id && $page == 'mecanicos' && $action == 'edit' ? $oficina->getMecanicoById($id) : null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Oficina Mecânica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            min-height: 100vh;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
            border-radius: 5px;
            margin: 2px 0;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: #3498db;
            color: white;
        }
        .card-stat {
            transition: transform 0.2s;
            border: none;
            border-radius: 10px;
        }
        .card-stat:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        .main-content {
            background-color: #f8f9fa;
        }
        .table th {
            background-color: #2c3e50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar d-md-block">
                <div class="position-sticky pt-3">
                    <div class="text-center text-white mb-4">
                        <h4><i class="fas fa-car me-2"></i>Oficina Mecânica</h4>
                        <hr class="bg-light">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>" href="?page=dashboard">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page == 'clientes' ? 'active' : '' ?>" href="?page=clientes">
                                <i class="fas fa-users"></i>
                                Clientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page == 'veiculos' ? 'active' : '' ?>" href="?page=veiculos">
                                <i class="fas fa-car"></i>
                                Veículos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page == 'servicos' ? 'active' : '' ?>" href="?page=servicos">
                                <i class="fas fa-tools"></i>
                                Serviços
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page == 'pecas' ? 'active' : '' ?>" href="?page=pecas">
                                <i class="fas fa-cogs"></i>
                                Peças
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page == 'mecanicos' ? 'active' : '' ?>" href="?page=mecanicos">
                                <i class="fas fa-user-cog"></i>
                                Mecânicos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page == 'fornecedores' ? 'active' : '' ?>" href="?page=fornecedores">
                                <i class="fas fa-truck"></i>
                                Fornecedores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page == 'ordens' ? 'active' : '' ?>" href="?page=ordens">
                                <i class="fas fa-clipboard-list"></i>
                                Ordens de Serviço
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page == 'agendamentos' ? 'active' : '' ?>" href="?page=agendamentos">
                                <i class="fas fa-calendar-alt"></i>
                                Agendamentos
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content px-md-4">
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    Operação realizada com sucesso!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <!-- Barra Superior -->
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>
                        <?= 
                            $page == 'dashboard' ? '<i class="fas fa-tachometer-alt me-2"></i>Dashboard' :
                            ($page == 'clientes' ? '<i class="fas fa-users me-2"></i>Clientes' :
                            ($page == 'veiculos' ? '<i class="fas fa-car me-2"></i>Veículos' :
                            ($page == 'servicos' ? '<i class="fas fa-tools me-2"></i>Serviços' :
                            ($page == 'pecas' ? '<i class="fas fa-cogs me-2"></i>Peças' :
                            ($page == 'mecanicos' ? '<i class="fas fa-user-cog me-2"></i>Mecânicos' :
                            ($page == 'fornecedores' ? '<i class="fas fa-truck me-2"></i>Fornecedores' :
                            ($page == 'ordens' ? '<i class="fas fa-clipboard-list me-2"></i>Ordens de Serviço' :
                            ($page == 'agendamentos' ? '<i class="fas fa-calendar-alt me-2"></i>Agendamentos' : 'Sistema'))))))))
                        ?>
                    </h2>
                    <div class="d-flex align-items-center">
                        <!-- Busca -->
                        <form class="d-flex me-3" method="GET">
                            <input type="hidden" name="page" value="busca">
                            <div class="input-group">
                                <input type="text" class="form-control" name="termo_busca" placeholder="Buscar...">
                                <button class="btn btn-outline-primary" type="submit" name="buscar">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                // Conteúdo das páginas
                switch ($page) {
                    case 'dashboard':
                        include_view_dashboard();
                        break;
                    case 'clientes':
                        if ($action == 'create' || $action == 'edit') {
                            include_view_cliente_form();
                        } else {
                            include_view_clientes();
                        }
                        break;
                    case 'veiculos':
                        if ($action == 'create' || $action == 'edit') {
                            include_view_veiculo_form();
                        } else {
                            include_view_veiculos();
                        }
                        break;
                    case 'servicos':
                        if ($action == 'create' || $action == 'edit') {
                            include_view_servico_form();
                        } else {
                            include_view_servicos();
                        }
                        break;
                    case 'pecas':
                        if ($action == 'create' || $action == 'edit') {
                            include_view_peca_form();
                        } else {
                            include_view_pecas();
                        }
                        break;
                    case 'mecanicos':
                        if ($action == 'create' || $action == 'edit') {
                            include_view_mecanico_form();
                        } else {
                            include_view_mecanicos();
                        }
                        break;
                    case 'fornecedores':
                        if ($action == 'create') {
                            include_view_fornecedor_form();
                        } else {
                            include_view_fornecedores();
                        }
                        break;
                    case 'ordens':
                        if ($action == 'create') {
                            include_view_ordem_form();
                        } else {
                            include_view_ordens();
                        }
                        break;
                    case 'agendamentos':
                        if ($action == 'create') {
                            include_view_agendamento_form();
                        } else {
                            include_view_agendamentos();
                        }
                        break;
                    case 'busca':
                        include_view_busca();
                        break;
                    default:
                        include_view_dashboard();
                }
                ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmarExclusao(mensagem) {
            return confirm(mensagem || 'Tem certeza que deseja excluir este item?');
        }
    </script>
</body>
</html>

<?php
// VIEWS

function include_view_dashboard() {
    global $estatisticas, $alertas, $ordens_servico, $agendamentos; ?>
    <!-- Alertas -->
    <?php if (!empty($alertas)): ?>
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-warning">
                <h6><i class="fas fa-exclamation-triangle me-2"></i>Alertas do Sistema</h6>
                <?php foreach (array_slice($alertas, 0, 3) as $alerta): ?>
                <div class="alert alert-<?= $alerta['nivel'] == 'critico' ? 'danger' : ($alerta['nivel'] == 'alerta' ? 'warning' : 'info') ?> mb-2">
                    <small><i class="fas fa-<?= $alerta['tipo'] == 'estoque' ? 'box' : 'calendar' ?> me-1"></i> <?= $alerta['mensagem'] ?></small>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Estatísticas -->
    <div class="row">
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="card text-white bg-primary card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4><?= $estatisticas['total_clientes'] ?></h4>
                            <p class="mb-0">Clientes</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="card text-white bg-success card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4><?= $estatisticas['total_veiculos'] ?></h4>
                            <p class="mb-0">Veículos</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-car stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="card text-white bg-warning card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>R$ <?= number_format($estatisticas['receita_mensal'], 2, ',', '.') ?></h4>
                            <p class="mb-0">Receita Mês</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-dollar-sign stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="card text-white bg-info card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4><?= $estatisticas['ordens_mes'] ?></h4>
                            <p class="mb-0">Ordens Mês</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clipboard-list stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="card text-white bg-danger card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4><?= $estatisticas['pecas_estoque_baixo'] ?></h4>
                            <p class="mb-0">Estoque Baixo</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ações Rápidas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-sm-4 mb-3">
                            <a href="?page=clientes&action=create" class="btn btn-primary w-100">
                                <i class="fas fa-user-plus me-1"></i>Novo Cliente
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 mb-3">
                            <a href="?page=veiculos&action=create" class="btn btn-success w-100">
                                <i class="fas fa-car me-1"></i>Novo Veículo
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 mb-3">
                            <a href="?page=ordens&action=create" class="btn btn-warning w-100">
                                <i class="fas fa-clipboard-list me-1"></i>Nova OS
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 mb-3">
                            <a href="?page=agendamentos&action=create" class="btn btn-info w-100">
                                <i class="fas fa-calendar me-1"></i>Novo Agendamento
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimas Ordens e Agendamentos -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Últimas Ordens de Serviço</h5>
                </div>
                <div class="card-body">
                    <?php foreach (array_slice($ordens_servico, 0, 5) as $ordem): ?>
                    <div class="border-bottom pb-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-1"><?= $ordem['cliente_nome'] ?></h6>
                                <small class="text-muted"><?= $ordem['veiculo_info'] ?></small>
                            </div>
                            <span class="badge bg-<?= $ordem['status'] == 'concluida' ? 'success' : 'warning' ?>">
                                <?= ucfirst($ordem['status']) ?>
                            </span>
                        </div>
                        <small class="text-muted">R$ <?= number_format($ordem['valor_total'], 2, ',', '.') ?></small>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Próximos Agendamentos</h5>
                </div>
                <div class="card-body">
                    <?php foreach (array_slice($agendamentos, 0, 5) as $agendamento): ?>
                    <div class="border-bottom pb-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-1"><?= $agendamento['cliente_nome'] ?></h6>
                                <small class="text-muted"><?= $agendamento['servico_solicitado'] ?></small>
                            </div>
                            <small class="text-muted"><?= date('d/m H:i', strtotime($agendamento['data_agendamento'])) ?></small>
                        </div>
                        <small class="text-muted"><?= $agendamento['veiculo_info'] ?></small>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php }

function include_view_clientes() {
    global $clientes; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Clientes Cadastrados</h4>
        <a href="?page=clientes&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Novo Cliente
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Data Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= $cliente['id'] ?></td>
                            <td><?= htmlspecialchars($cliente['nome']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                            <td><?= htmlspecialchars($cliente['email']) ?></td>
                            <td>
                                <span class="badge bg-<?= $cliente['tipo'] == 'premium' ? 'warning' : 'secondary' ?>">
                                    <?= ucfirst($cliente['tipo']) ?>
                                </span>
                            </td>
                            <td><?= $cliente['data_cadastro'] ?></td>
                            <td>
                                <a href="?page=clientes&action=edit&id=<?= $cliente['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=clientes&action=delete&id=<?= $cliente['id'] ?>" class="btn btn-sm btn-danger" 
                                   onclick="return confirmarExclusao()">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }

function include_view_cliente_form() {
    global $cliente_edicao; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><?= $cliente_edicao ? 'Editar Cliente' : 'Novo Cliente' ?></h4>
        <a href="?page=clientes" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome *</label>
                        <input type="text" class="form-control" name="nome" value="<?= $cliente_edicao ? htmlspecialchars($cliente_edicao['nome']) : '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $cliente_edicao ? htmlspecialchars($cliente_edicao['email']) : '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefone *</label>
                        <input type="text" class="form-control" name="telefone" value="<?= $cliente_edicao ? htmlspecialchars($cliente_edicao['telefone']) : '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CPF *</label>
                        <input type="text" class="form-control" name="cpf" value="<?= $cliente_edicao ? htmlspecialchars($cliente_edicao['cpf']) : '' ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Endereço</label>
                    <textarea class="form-control" name="endereco" rows="3"><?= $cliente_edicao ? htmlspecialchars($cliente_edicao['endereco']) : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de Cliente</label>
                    <select class="form-select" name="tipo">
                        <option value="regular" <?= $cliente_edicao && $cliente_edicao['tipo'] == 'regular' ? 'selected' : '' ?>>Regular</option>
                        <option value="premium" <?= $cliente_edicao && $cliente_edicao['tipo'] == 'premium' ? 'selected' : '' ?>>Premium</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    <?= $cliente_edicao ? 'Atualizar' : 'Cadastrar' ?>
                </button>
            </form>
        </div>
    </div>
<?php }

function include_view_veiculos() {
    global $veiculos; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Veículos Cadastrados</h4>
        <a href="?page=veiculos&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Novo Veículo
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Marca/Modelo</th>
                            <th>Placa</th>
                            <th>Ano</th>
                            <th>Cor</th>
                            <th>KM</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($veiculos as $veiculo): ?>
                        <tr>
                            <td><?= $veiculo['id'] ?></td>
                            <td><?= htmlspecialchars($veiculo['cliente_nome']) ?></td>
                            <td>
                                <strong><?= htmlspecialchars($veiculo['marca']) ?></strong><br>
                                <small class="text-muted"><?= htmlspecialchars($veiculo['modelo']) ?></small>
                            </td>
                            <td><?= htmlspecialchars($veiculo['placa']) ?></td>
                            <td><?= $veiculo['ano'] ?></td>
                            <td><?= htmlspecialchars($veiculo['cor']) ?></td>
                            <td><?= number_format($veiculo['km_atual'], 0, ',', '.') ?> km</td>
                            <td>
                                <a href="?page=veiculos&action=edit&id=<?= $veiculo['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=veiculos&action=delete&id=<?= $veiculo['id'] ?>" class="btn btn-sm btn-danger" 
                                   onclick="return confirmarExclusao()">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }

function include_view_veiculo_form() {
    global $veiculo_edicao, $clientes; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><?= $veiculo_edicao ? 'Editar Veículo' : 'Novo Veículo' ?></h4>
        <a href="?page=veiculos" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cliente *</label>
                        <select class="form-select" name="cliente_id" required>
                            <option value="">Selecione um cliente</option>
                            <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>" 
                                <?= ($veiculo_edicao && $veiculo_edicao['cliente_id'] == $cliente['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cliente['nome']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Placa *</label>
                        <input type="text" class="form-control" name="placa" value="<?= $veiculo_edicao ? htmlspecialchars($veiculo_edicao['placa']) : '' ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Marca *</label>
                        <input type="text" class="form-control" name="marca" value="<?= $veiculo_edicao ? htmlspecialchars($veiculo_edicao['marca']) : '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Modelo *</label>
                        <input type="text" class="form-control" name="modelo" value="<?= $veiculo_edicao ? htmlspecialchars($veiculo_edicao['modelo']) : '' ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ano *</label>
                        <input type="number" class="form-control" name="ano" value="<?= $veiculo_edicao ? $veiculo_edicao['ano'] : date('Y') ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cor</label>
                        <input type="text" class="form-control" name="cor" value="<?= $veiculo_edicao ? htmlspecialchars($veiculo_edicao['cor']) : '' ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">KM Atual</label>
                        <input type="number" class="form-control" name="km_atual" value="<?= $veiculo_edicao ? $veiculo_edicao['km_atual'] : '0' ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    <?= $veiculo_edicao ? 'Atualizar' : 'Cadastrar' ?>
                </button>
            </form>
        </div>
    </div>
<?php }

function include_view_servicos() {
    global $servicos; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Serviços Cadastrados</h4>
        <a href="?page=servicos&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Novo Serviço
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Tempo</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicos as $servico): ?>
                        <tr>
                            <td><?= $servico['id'] ?></td>
                            <td><strong><?= htmlspecialchars($servico['nome']) ?></strong></td>
                            <td><?= htmlspecialchars($servico['descricao']) ?></td>
                            <td>R$ <?= number_format($servico['preco'], 2, ',', '.') ?></td>
                            <td><?= $servico['tempo_estimado'] ?>h</td>
                            <td><?= htmlspecialchars($servico['categoria']) ?></td>
                            <td>
                                <a href="?page=servicos&action=edit&id=<?= $servico['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=servicos&action=delete&id=<?= $servico['id'] ?>" class="btn btn-sm btn-danger" 
                                   onclick="return confirmarExclusao()">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }

function include_view_servico_form() {
    global $servico_edicao; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><?= $servico_edicao ? 'Editar Serviço' : 'Novo Serviço' ?></h4>
        <a href="?page=servicos" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome do Serviço *</label>
                    <input type="text" class="form-control" name="nome" value="<?= $servico_edicao ? htmlspecialchars($servico_edicao['nome']) : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" name="descricao" rows="3"><?= $servico_edicao ? htmlspecialchars($servico_edicao['descricao']) : '' ?></textarea>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Preço (R$) *</label>
                        <input type="number" step="0.01" class="form-control" name="preco" value="<?= $servico_edicao ? $servico_edicao['preco'] : '' ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tempo Estimado *</label>
                        <input type="text" class="form-control" name="tempo_estimado" value="<?= $servico_edicao ? $servico_edicao['tempo_estimado'] : '' ?>" placeholder="Ex: 1:30" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Categoria</label>
                        <input type="text" class="form-control" name="categoria" value="<?= $servico_edicao ? htmlspecialchars($servico_edicao['categoria']) : '' ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    <?= $servico_edicao ? 'Atualizar' : 'Cadastrar' ?>
                </button>
            </form>
        </div>
    </div>
<?php }

function include_view_pecas() {
    global $pecas; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Peças Cadastradas</h4>
        <a href="?page=pecas&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Nova Peça
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço Compra</th>
                            <th>Preço Venda</th>
                            <th>Estoque</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pecas as $peca): ?>
                        <tr>
                            <td><?= $peca['id'] ?></td>
                            <td><strong><?= htmlspecialchars($peca['nome']) ?></strong></td>
                            <td><?= htmlspecialchars($peca['descricao']) ?></td>
                            <td>R$ <?= number_format($peca['preco_compra'], 2, ',', '.') ?></td>
                            <td>R$ <?= number_format($peca['preco_venda'], 2, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-<?= $peca['estoque'] > $peca['estoque_minimo'] ? 'success' : 'danger' ?>">
                                    <?= $peca['estoque'] ?> unidades
                                </span>
                            </td>
                            <td><?= htmlspecialchars($peca['categoria']) ?></td>
                            <td>
                                <a href="?page=pecas&action=edit&id=<?= $peca['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=pecas&action=delete&id=<?= $peca['id'] ?>" class="btn btn-sm btn-danger" 
                                   onclick="return confirmarExclusao()">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }

function include_view_peca_form() {
    global $peca_edicao, $fornecedores; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><?= $peca_edicao ? 'Editar Peça' : 'Nova Peça' ?></h4>
        <a href="?page=pecas" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome da Peça *</label>
                    <input type="text" class="form-control" name="nome" value="<?= $peca_edicao ? htmlspecialchars($peca_edicao['nome']) : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" name="descricao" rows="3"><?= $peca_edicao ? htmlspecialchars($peca_edicao['descricao']) : '' ?></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Preço de Compra (R$) *</label>
                        <input type="number" step="0.01" class="form-control" name="preco_compra" value="<?= $peca_edicao ? $peca_edicao['preco_compra'] : '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Preço de Venda (R$) *</label>
                        <input type="number" step="0.01" class="form-control" name="preco_venda" value="<?= $peca_edicao ? $peca_edicao['preco_venda'] : '' ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Estoque *</label>
                        <input type="number" class="form-control" name="estoque" value="<?= $peca_edicao ? $peca_edicao['estoque'] : '' ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Estoque Mínimo *</label>
                        <input type="number" class="form-control" name="estoque_minimo" value="<?= $peca_edicao ? $peca_edicao['estoque_minimo'] : '5' ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Categoria</label>
                        <input type="text" class="form-control" name="categoria" value="<?= $peca_edicao ? htmlspecialchars($peca_edicao['categoria']) : '' ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    <?= $peca_edicao ? 'Atualizar' : 'Cadastrar' ?>
                </button>
            </form>
        </div>
    </div>
<?php }

function include_view_mecanicos() {
    global $mecanicos; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Mecânicos Cadastrados</h4>
        <a href="?page=mecanicos&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Novo Mecânico
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Especialidade</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Salário</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mecanicos as $mecanico): ?>
                        <tr>
                            <td><?= $mecanico['id'] ?></td>
                            <td><strong><?= htmlspecialchars($mecanico['nome']) ?></strong></td>
                            <td><?= htmlspecialchars($mecanico['especialidade']) ?></td>
                            <td><?= htmlspecialchars($mecanico['telefone']) ?></td>
                            <td><?= htmlspecialchars($mecanico['email']) ?></td>
                            <td>R$ <?= number_format($mecanico['salario'], 2, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-<?= $mecanico['ativo'] ? 'success' : 'secondary' ?>">
                                    <?= $mecanico['ativo'] ? 'Ativo' : 'Inativo' ?>
                                </span>
                            </td>
                            <td>
                                <a href="?page=mecanicos&action=edit&id=<?= $mecanico['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=mecanicos&action=delete&id=<?= $mecanico['id'] ?>" class="btn btn-sm btn-danger" 
                                   onclick="return confirmarExclusao()">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }

function include_view_mecanico_form() {
    global $mecanico_edicao; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><?= $mecanico_edicao ? 'Editar Mecânico' : 'Novo Mecânico' ?></h4>
        <a href="?page=mecanicos" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome *</label>
                        <input type="text" class="form-control" name="nome" value="<?= $mecanico_edicao ? htmlspecialchars($mecanico_edicao['nome']) : '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Especialidade *</label>
                        <input type="text" class="form-control" name="especialidade" value="<?= $mecanico_edicao ? htmlspecialchars($mecanico_edicao['especialidade']) : '' ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefone *</label>
                        <input type="text" class="form-control" name="telefone" value="<?= $mecanico_edicao ? htmlspecialchars($mecanico_edicao['telefone']) : '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $mecanico_edicao ? htmlspecialchars($mecanico_edicao['email']) : '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Salário (R$)</label>
                        <input type="number" step="0.01" class="form-control" name="salario" value="<?= $mecanico_edicao ? $mecanico_edicao['salario'] : '' ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check mt-4">
                            <input type="checkbox" class="form-check-input" name="ativo" id="ativo" 
                                <?= ($mecanico_edicao && $mecanico_edicao['ativo']) || !$mecanico_edicao ? 'checked' : '' ?>>
                            <label class="form-check-label" for="ativo">Mecânico Ativo</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    <?= $mecanico_edicao ? 'Atualizar' : 'Cadastrar' ?>
                </button>
            </form>
        </div>
    </div>
<?php }

function include_view_fornecedores() {
    global $fornecedores; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Fornecedores Cadastrados</h4>
        <a href="?page=fornecedores&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Novo Fornecedor
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Contato</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Endereço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fornecedores as $fornecedor): ?>
                        <tr>
                            <td><?= $fornecedor['id'] ?></td>
                            <td><strong><?= htmlspecialchars($fornecedor['nome']) ?></strong></td>
                            <td><?= htmlspecialchars($fornecedor['contato']) ?></td>
                            <td><?= htmlspecialchars($fornecedor['telefone']) ?></td>
                            <td><?= htmlspecialchars($fornecedor['email']) ?></td>
                            <td><?= htmlspecialchars($fornecedor['endereco']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }

function include_view_fornecedor_form() { ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Novo Fornecedor</h4>
        <a href="?page=fornecedores" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome da Empresa *</label>
                    <input type="text" class="form-control" name="nome" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contato *</label>
                        <input type="text" class="form-control" name="contato" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefone *</label>
                        <input type="text" class="form-control" name="telefone" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Endereço</label>
                    <textarea class="form-control" name="endereco" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Cadastrar Fornecedor
                </button>
            </form>
        </div>
    </div>
<?php }

function include_view_ordens() {
    global $ordens_servico; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Ordens de Serviço</h4>
        <a href="?page=ordens&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Nova Ordem
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Veículo</th>
                            <th>Data Abertura</th>
                            <th>Mecânico</th>
                            <th>Valor Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ordens_servico as $ordem): ?>
                        <tr>
                            <td><?= $ordem['id'] ?></td>
                            <td><?= htmlspecialchars($ordem['cliente_nome']) ?></td>
                            <td><?= htmlspecialchars($ordem['veiculo_info']) ?></td>
                            <td><?= $ordem['data_abertura'] ?></td>
                            <td><?= htmlspecialchars($ordem['mecanico_nome']) ?></td>
                            <td>R$ <?= number_format($ordem['valor_total'], 2, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-<?= $ordem['status'] == 'concluida' ? 'success' : 'warning' ?>">
                                    <?= ucfirst($ordem['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }

function include_view_ordem_form() {
    global $veiculos, $mecanicos; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Nova Ordem de Serviço</h4>
        <a href="?page=ordens" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Veículo *</label>
                        <select class="form-select" name="veiculo_id" required>
                            <option value="">Selecione um veículo</option>
                            <?php foreach ($veiculos as $veiculo): ?>
                            <option value="<?= $veiculo['id'] ?>">
                                <?= htmlspecialchars($veiculo['cliente_nome']) ?> - <?= htmlspecialchars($veiculo['marca']) ?> <?= htmlspecialchars($veiculo['modelo']) ?> (<?= htmlspecialchars($veiculo['placa']) ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mecânico *</label>
                        <select class="form-select" name="mecanico_id" required>
                            <option value="">Selecione um mecânico</option>
                            <?php foreach ($mecanicos as $mecanico): ?>
                            <option value="<?= $mecanico['id'] ?>">
                                <?= htmlspecialchars($mecanico['nome']) ?> - <?= htmlspecialchars($mecanico['especialidade']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status *</label>
                        <select class="form-select" name="status" required>
                            <option value="aberta">Aberta</option>
                            <option value="em_andamento">Em Andamento</option>
                            <option value="concluida">Concluída</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Valor Total (R$) *</label>
                        <input type="number" step="0.01" class="form-control" name="valor_total" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea class="form-control" name="observacoes" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Criar Ordem de Serviço
                </button>
            </form>
        </div>
    </div>
<?php }

function include_view_agendamentos() {
    global $agendamentos; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Agendamentos</h4>
        <a href="?page=agendamentos&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Novo Agendamento
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Veículo</th>
                            <th>Data/Hora</th>
                            <th>Serviço</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($agendamentos as $agendamento): ?>
                        <tr>
                            <td><?= $agendamento['id'] ?></td>
                            <td><?= htmlspecialchars($agendamento['cliente_nome']) ?></td>
                            <td><?= htmlspecialchars($agendamento['veiculo_info']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($agendamento['data_agendamento'])) ?></td>
                            <td><?= htmlspecialchars($agendamento['servico_solicitado']) ?></td>
                            <td>
                                <span class="badge bg-<?= $agendamento['status'] == 'confirmado' ? 'success' : 'primary' ?>">
                                    <?= ucfirst($agendamento['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }

function include_view_agendamento_form() {
    global $veiculos; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Novo Agendamento</h4>
        <a href="?page=agendamentos" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Veículo *</label>
                        <select class="form-select" name="veiculo_id" required>
                            <option value="">Selecione um veículo</option>
                            <?php foreach ($veiculos as $veiculo): ?>
                            <option value="<?= $veiculo['id'] ?>">
                                <?= htmlspecialchars($veiculo['cliente_nome']) ?> - <?= htmlspecialchars($veiculo['marca']) ?> <?= htmlspecialchars($veiculo['modelo']) ?> (<?= htmlspecialchars($veiculo['placa']) ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data e Hora *</label>
                        <input type="datetime-local" class="form-control" name="data_agendamento" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Serviço Solicitado *</label>
                    <input type="text" class="form-control" name="servico_solicitado" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="agendado">Agendado</option>
                        <option value="confirmado">Confirmado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea class="form-control" name="observacoes" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Agendar
                </button>
            </form>
        </div>
    </div>
<?php }

function include_view_busca() {
    global $resultados_busca; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Resultados da Busca</h4>
        <a href="javascript:history.back()" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (empty($resultados_busca)): ?>
            <div class="text-center py-4">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhum resultado encontrado</h5>
                <p class="text-muted">Tente buscar por nome, telefone, placa ou modelo</p>
            </div>
            <?php else: ?>
                <?php if (!empty($resultados_busca['clientes'])): ?>
                <h5 class="mb-3">
                    <i class="fas fa-users me-2 text-primary"></i>
                    Clientes Encontrados (<?= count($resultados_busca['clientes']) ?>)
                </h5>
                <div class="table-responsive mb-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Email</th>
                                <th>CPF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados_busca['clientes'] as $cliente): ?>
                            <tr>
                                <td><?= htmlspecialchars($cliente['nome']) ?></td>
                                <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                                <td><?= htmlspecialchars($cliente['email']) ?></td>
                                <td><?= htmlspecialchars($cliente['cpf']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>

                <?php if (!empty($resultados_busca['veiculos'])): ?>
                <h5 class="mb-3">
                    <i class="fas fa-car me-2 text-success"></i>
                    Veículos Encontrados (<?= count($resultados_busca['veiculos']) ?>)
                </h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Marca/Modelo</th>
                                <th>Ano</th>
                                <th>Cor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados_busca['veiculos'] as $veiculo): ?>
                            <tr>
                                <td><?= htmlspecialchars($veiculo['placa']) ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($veiculo['marca']) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($veiculo['modelo']) ?></small>
                                </td>
                                <td><?= $veiculo['ano'] ?></td>
                                <td><?= htmlspecialchars($veiculo['cor']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php }
?>