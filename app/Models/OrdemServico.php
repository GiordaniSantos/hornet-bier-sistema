<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusOrdemServico;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordem_servicos';

    protected $fillable = ['status', 'modelo', 'serie', 'numero_motor', 'valor', 'cliente_id', 'observacao'];

    public static function rules(): array
    {
        return [
            'modelo' => 'max:300',
            'numero_motor' => 'max:300',
            'observacao' => 'max:1000',
            'serie' => 'max:200',
            //'valor' => 'numeric',
            'cliente_id' => 'required|exists:clientes,id'
        ];
    }

    public static function feedback(): array
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'numero_motor.max' => 'O campo Número do Motor não pode ultrapassar 300 caracteres.',
            'observacao.max' => 'O campo Observação não pode ultrapassar 1000 caracteres.',
            'modelo.max' => 'O campo :attribute não pode ultrapassar 300 caracteres.',
            'serie.max' => 'O campo :attribute não pode ultrapassar 200 caracteres.',
            'cliente_id.exists' => 'O cliente informado não existe!',
            'cliente_id.required' => 'O cliente deve ser selecionado!',
            //'valor.numeric' => "O campo :attribute deve ser do tipo numérico"
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            if (!$model->numero) {
                $model->numero = $model->id.'.'.$model->cliente->id.'.'.date('Y');
                $model->save();
            }
            if (!$model->status) {
                $model->status = StatusOrdemServico::Aberto->value;
                $model->save();
            }
        });
    }

    public function getStatusFormatado()
    {
        return match ($this->status) {
            StatusOrdemServico::Aberto->value => 'Aberto',
            StatusOrdemServico::Fechado->value => 'Fechado',
            StatusOrdemServico::EmAndamento->value => 'Em Andamento',
            StatusOrdemServico::NaoExecutado->value => 'Não Executado',
            default => 'Status desconhecido',
        };
    }

    public function isMobile() 
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));

    }
    
    public function getWhatsappLink() 
    {
        if (!($this->cliente->celular)) {
            return false;
        }

        $whats = preg_replace('/[^0-9]/i', '', $this->cliente->celular);
        $mensagem = 'Olá '.$this->cliente->nome.', para acessar seu orçamento de ordem de serviço n° '.$this->numero.' e acompanhar o status do andamento do serviço basta acessar o seguinte link: '.route('orcamento', ['id' => $this->id]);
        
        $msg = urlencode($mensagem);
        $url = $this->isMobile()?"https://api.whatsapp.com/send?phone=55{$whats}&text={$msg}":"https://web.whatsapp.com/send?phone=55{$whats}&text={$msg}";

        return $url;
    }


    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }

    public function problemas()
    {
        return $this->belongsToMany(Problema::class, 'ordem_servico_problemas', 'ordem_servico_id', 'problema_id');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'ordem_servico_servicos', 'ordem_servico_id', 'servico_id');
    }

    public function pecas()
    {
        return $this->belongsToMany(Peca::class, 'ordem_servico_pecas', 'ordem_servico_id', 'peca_id')->withPivot(['quantidade', 'valor_peca']);
    }
}
