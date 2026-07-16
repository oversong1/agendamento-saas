<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * CONCEITO GERAL: O QUE É UM MIDDLEWARE?
 * 
 * Um Middleware funciona como uma "camada de inspeção" ou um "filtro" para as requisições 
 * HTTP que chegam na sua aplicação. Ele fica exatamente no meio do caminho entre o 
 * clique do usuário e a execução da lógica final (o seu Controller).
 * 
 * Pense nele como um segurança de festa: ele analisa quem está tentando entrar (Request),
 * faz validações, pode adicionar informações na requisição e, se tudo estiver certo,
 * permite que ela continue para o próximo passo. Se algo estiver errado, ele barra ali mesmo.
 */
class ResolveTenantBySlug
{
    /**
     * O método 'handle' é o gatilho automático do Middleware.
     * Toda requisição enviada para as rotas que usam este middleware passará por aqui primeiro.
     * 
     * @param Request $request -> Objeto que traz todos os dados da requisição (URL, inputs, etc.)
     * @param Closure $next    -> A função que representa o próximo passo da aplicação (o Controller)
     */
    public function handle(Request $request, Closure $next): Response
    {
        // PASSO 1: Captura o parâmetro dinâmico da URL definido na rota (ex: /empresa-xyz)
        $slug = $request->route('slug');

        // PASSO 2: Consulta o banco de dados usando o Model 'Company'
        // Busca uma empresa pelo slug obtido E que esteja com o status ativo no sistema
        $company = Company::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        // PASSO 3: Validação (O "Segurança" barrando a entrada)
        // Se a query não retornar nenhuma empresa (for nula), interrompe a requisição imediatamente
        if (! $company) {
            abort(404, 'Empresa não encontrada.');
        }

        // PASSO 4: O "Carimbo" (Injeção de dependência na memória)
        // Como já encontramos a empresa, salvamos ela dentro do Service Container do Laravel.
        // Isso transforma o objeto $company em algo "global" nesta requisição.
        // Você poderá chamá-la em qualquer Controller ou View usando: app('currentCompany')
        app()->instance('currentCompany', $company);

        // PASSO 5: Autorização (O "Segurança" deixando passar)
        // Envia a requisição adiante. O Laravel agora vai executar o Controller da rota solicitada.
        return $next($request);
    }
}