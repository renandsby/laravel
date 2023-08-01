 {{-- cria token no hidden automatico --}}
@csrf()
{{-- <input type="text" value="{{ csrf_token() }}" name="_token"> --}}
<input type="text" placeholder="Assunto" name="subject" value="{{$support->subject ?? old('subject')}}">
<textarea name="body" cols="30" rows="5" placeholder="Descrição">{{$support->body ?? old('body')}}</textarea>
<button type="submit">Enviar</button>
