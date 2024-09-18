import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormControl, FormGroup, ReactiveFormsModule, ValidationErrors, Validators } from '@angular/forms';
import { ClientesService } from 'src/app/Services/clientes.service';
import { ICliente } from 'src/app/Interfaces/icliente';
import { CommonModule } from '@angular/common';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';
import { TuristaService } from 'src/app/Services/turistas.service';
import { ITurista } from 'src/app/Interfaces/turistas.interface';
@Component({
  selector: 'app-nuevocliente',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './nuevocliente.component.html',
})
export class NuevoTuristaComponent implements OnInit {
  frm_Cliente = new FormGroup({
    //idClientes: new FormControl(),
    nombre: new FormControl('', Validators.required),
    apellido: new FormControl('', Validators.required),
    email: new FormControl('',[ Validators.required, ]),
    telefono: new FormControl('', [Validators.required, ]),
  });
  turista_id = 0;
  titulo = 'Nuevo Turista';
  constructor(
    private turistaService: TuristaService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.turista_id = parseInt(this.ruta.snapshot.paramMap.get('id'));
    if (this.turista_id > 0) {
      this.turistaService.uno(this.turista_id.toString()).subscribe((turista) => {
        this.frm_Cliente.controls['nombre'].setValue(turista.nombre);
        this.frm_Cliente.controls['apellido'].setValue(turista.apellido);
        this.frm_Cliente.controls['email'].setValue(turista.email);
        this.frm_Cliente.controls['telefono'].setValue(turista.telefono);


        this.titulo = 'Editar Turista';
      });
    }
  }

  grabar() {
    
    let turista: ITurista = {
      turista_id: this.turista_id.toString(),
      nombre: this.frm_Cliente.controls['nombre'].value,
      apellido: this.frm_Cliente.controls['apellido'].value,
      email: this.frm_Cliente.controls['email'].value,
      telefono: this.frm_Cliente.controls['telefono'].value,
    }
        if (this.turista_id > 0) {
          this.turistaService.actualizar(turista).subscribe((res: any) => {
            Swal.fire({
              title: 'Turista',
              text: 'Turista Actualizado Correctamente',
              icon: 'success'
            });
            this.navegacion.navigate(['/turistas']);
          });
        } else {
          this.turistaService.insertar(turista).subscribe((res: any) => {
            Swal.fire({
              title: 'turistas',
              text: 'Turista Ingresado Correctamente',
              icon: 'success'
            });
            this.navegacion.navigate(['/turistas']);
          });
        }
  }


}
