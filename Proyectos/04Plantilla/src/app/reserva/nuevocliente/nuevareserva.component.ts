import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormControl, FormGroup, FormsModule, ReactiveFormsModule, ValidationErrors, Validators } from '@angular/forms';
import { ClientesService } from 'src/app/Services/clientes.service';
import { ICliente } from 'src/app/Interfaces/icliente';
import { CommonModule } from '@angular/common';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';
import { ITurista } from 'src/app/Interfaces/turistas.interface';
import { IDestino } from 'src/app/Interfaces/destino.interface';
import { ReservaService } from 'src/app/Services/reserva.service';
import { IReserva } from 'src/app/Interfaces/reserva.interface';
import { TuristaService } from 'src/app/Services/turistas.service';
import { DestinoService } from 'src/app/Services/destino.service';
@Component({
  selector: 'app-nuevocliente',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule,  FormsModule ],
  templateUrl: './nuevocliente.component.html',
})
export class NuevaReservaComponent implements OnInit {
  frm_Reserva = new FormGroup({
    //idClientes: new FormControl(),
    turista_id: new FormControl('', Validators.required),
    destino_id: new FormControl('', Validators.required),
    fecha_reserva: new FormControl('', Validators.required),
    numero_personas: new FormControl('1', [Validators.required, ]),
    costo_final: new FormControl('', [Validators.required, ]),
  });
  reserva_id = 0;
  titulo = 'Nuevo Cliente';
  turistas: ITurista[];
  destinos: IDestino[];
  constructor(
    private reservaService: ReservaService,
    private turistaService: TuristaService,
    private destinoService: DestinoService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.reserva_id = parseInt(this.ruta.snapshot.paramMap.get('id'));
    this.cargarTuristas();
    this.cargarDestinos();
    if (this.reserva_id > 0) {
      this.reservaService.uno(this.reserva_id.toString()).subscribe((reserva) => {
        this.frm_Reserva.controls['turista_id'].setValue(reserva.turista_id);
        this.frm_Reserva.controls['destino_id'].setValue(reserva.destino_id + ' destino ' + reserva.destino_costo);
        this.frm_Reserva.controls['fecha_reserva'].setValue(reserva.fecha_reserva);
        this.frm_Reserva.controls['numero_personas'].setValue(reserva.numero_personas);
        this.frm_Reserva.controls['costo_final'].setValue(reserva.costo_final);
        /*this.frm_Reserva.setValue({
          Nombres: uncliente.Nombres,
          Direccion: uncliente.Direccion,
          Telefono: uncliente.Telefono,
          Cedula: uncliente.Cedula,
          Correo: uncliente.Correo
        });*/
        /*this.frm_Reserva.patchValue({
          Cedula: uncliente.Cedula,
          Correo: uncliente.Correo,
          Nombres: uncliente.Nombres,
          Direccion: uncliente.Direccion,
          Telefono: uncliente.Telefono
        });*/
        this.calcularprecioFinal();
        this.titulo = 'Editar Reserva';
      });
    }
    this.frm_Reserva.controls['numero_personas'].valueChanges.subscribe(() => {
      this.calcularprecioFinal();
    });
  
    this.frm_Reserva.controls['destino_id'].valueChanges.subscribe(() => {
      this.calcularprecioFinal();
    });
  }
  calcularprecioFinal(){
    this.frm_Reserva.controls['costo_final'].setValue((parseFloat(this.frm_Reserva.controls['numero_personas'].value) * parseFloat(this.frm_Reserva.controls['destino_id'].value.split(' destino ')[1])).toString());
  }

  cargarTuristas() {
    this.turistaService.todos().subscribe((turistas) => {
      this.turistas = turistas;
    });
  }
  cargarDestinos() {
    this.destinoService.todos().subscribe((destinos) => {
      this.destinos = destinos;
    });
  }


  grabar() {
    let reserva: IReserva = {
      reserva_id: this.reserva_id.toString(),
      turista_id: this.frm_Reserva.controls['turista_id'].value,
      destino_id: this.frm_Reserva.controls['destino_id'].value.split(' destino ')[0],
      fecha_reserva: this.frm_Reserva.controls['fecha_reserva'].value,
      numero_personas: this.frm_Reserva.controls['numero_personas'].value,
      costo_final: this.frm_Reserva.controls['costo_final'].value
      

    };


        if (this.reserva_id > 0) {
          this.reservaService.actualizar(reserva).subscribe((res: any) => {
            Swal.fire({
              title: 'Reserva',
              text: 'Reserva Actualizada correctamente',
              icon: 'success'
            });
            this.navegacion.navigate(['/reserva']);
          });
        } else {
          this.reservaService.insertar(reserva).subscribe((res: any) => {
            Swal.fire({
              title: 'Reserva',
              text: 'Reserva Ingresada correctamente',
              icon: 'success'
            });
            this.navegacion.navigate(['/reserva']);
          });
        }

  }


}
