import React, { Component } from 'react'
import axios from 'axios';

class SinodaliasTable extends Component {
	constructor(props) {
		super(props)
		this.state = {
			sinodalias: [],
			teachers: [],
			periodosAct: [],
			periodoSeleccionado: 0,
			teachersSeleccionado: '',
			ready: false,
			sinodaliasListLength: 0,
			minPage: 1,
			maxPage: 1,
			actualPage: 1,
			minSino:0,
			maxSino: 4,
			residuo: 0,
			teacherFiltered: null,
		}

		// bindings
		this.compareTeaching = this.compareTeaching.bind(this)
		this.getSinodaliasData = this.getSinodaliasData.bind(this)
		this.linked = this.linked.bind(this)
		this.pullPeriodo = this.pullPeriodo.bind(this)
		this.pullTeachers = this.pullTeachers.bind(this)
		this.previousPage = this.previousPage.bind(this)
		this.nextPage = this.nextPage.bind(this)
	}

	// traer las sinodalias
		componentWillMount () {
			this.getPeriodosAbiertos()
			this.getSinodaliasData()
			// last
			this.getTeachersData()
		}

		componentDidMount() {
			// actualizar cada 10 segundos
			this.interval = setInterval(() => this.getSinodaliasData(), 10000)
		}

		componentWillUnmount() {
			// limpiar el montaje
			clearInterval(this.interval)
		}

		getSinodaliasData() {
			axios.get('/sinodalias')
			.then((response) => {
				console.log(response)
				let sinodaliasList = response.data.sinodalias
				let validSinodalias = []
				sinodaliasList.map((sinodal) => {
					(sinodal.periodo_id == this.state.periodoSeleccionado) && validSinodalias.push(sinodal)
				})
				this.setState({
					sinodalias: [...validSinodalias],
					sinodaliasListLength: [...validSinodalias].length,
				})
				
				// calculando las paginas de 5 en 5
				let pages = this.state.sinodaliasListLength / 5
				// console.log("Pages will be: ", pages)
				let residuos = this.state.sinodaliasListLength % 5

				if(residuos >0){
					// console.log("pagina extra")
					pages++
					pages = Math.floor(pages)
					//console.log("pages now is: ", pages)
				}
				this.setState({
					maxPage: pages,
					residuo: residuos,
				})

				console.log(this.state.maxPage)
			})
			.catch(error => {
  			console.log(error.message);
			})
		}

		getTeachersData() {
		axios.get('/teachers')
		.then((response) => {
					console.log("done")
					this.setState({
						teachers: [...response.data.teachers],
					})
				}
			)
		}

		compareTeaching(sinodal) {
			let teacher= ''
			// buscando el maestro que corresponde al id
			for(let i = 0; i < this.state.teachers.length; i++){
				if (this.state.teachers[i].id == sinodal) {
					teacher = this.state.teachers[i].name
				}
			}
			return teacher
		}

		// link manual
		linked(id){
			return '/sinodalias/'+id
		}

		// cargar los periodos para filtrar las sinodalias
		getPeriodosAbiertos() {
			axios.get('/periodosDisponibles')
			.then((response) => {
				this.setState({
					periodosAct: [...response.data.periodosActivos],
					periodoSeleccionado: response.data.periodosActivos[0].id,
					ready: true,
				})
			})
		}

		// renderiza la tabla completa, puede llamarse
		showTableContent() {
			console.log("minSino: ", this.state.minSino)
			console.log("maxSino: ", this.state.maxSino)
			console.log("maxPage: ", this.state.maxPage)
			console.log("residuo: ", this.state.residuo)
			let min_sino = this.state.minSino
			let max_sino = this.state.maxSino
			// filtrado por maestro por aplicar
			let teacherFiltered = this.state.teacherFiltered
			let userFilter = teacherFiltered != null ? teacherFiltered : false
			console.log("Filtrado en existencia: ", userFilter)
			if (!userFilter) {
				return (
					this.state.sinodalias.map((sinodalia, key) => (						
					  			(((key >= min_sino) && (key <= max_sino) && !userFilter) &&
					  					<tr key={sinodalia.id}>
							  				<td>{key+1}</td>
									      <th scope="row">{sinodalia.residente}</th>
									      <td>{sinodalia.proyecto}</td>
									      <td>{sinodalia.carrera}</td>
									      <td>{sinodalia.num_control}</td>
									      <td>{this.compareTeaching(sinodalia.user_id)}</td>
									      <td>{this.compareTeaching(sinodalia.id_secretario)}</td>
									      <td>{this.compareTeaching(sinodalia.id_vocal)}</td>
									      <td>{this.compareTeaching(sinodalia.id_vocal_sup)}</td>
									      <td>
									      <a href={this.linked(sinodalia.id)} className="btn btn-success">
									      			Editar</a>
									      { sinodalia.proyecto_aprobacion ? " ✔" : ""}
									      { sinodalia.aprobacion ? " ✔" : ""}
									      </td>
									    </tr>
					  			 )
					  		))
				)
			}
			else {
				return <tr>hola {userFilter}</tr>
			}
		}

		// se trae los datos del formulario para el filtro
		// por periodo
		pullPeriodo() {
			// quitar filtro por profesor
			this.setState({
				teacherFiltered: null,
			})
			let id = document.getElementById("periodos-form")

			// cambiando el id del periodo para mostrarlos
			this.setState({
				periodoSeleccionado: id.value,
			})
			// console.log("pullPeriodo: "+id.value)
			// peticion axios para traerse todos los datos
			this.getSinodaliasData()
		}
		pullTeachers() {
			// pasa el id del profesor desde el filtro
			let id = document.getElementById("teachers-form")
			this.setState({
				teacherFiltered: id.value
			})
			// console.log("teacher filtered: ", this.state.teacherFiltered)
		}

		previousPage(){
			// cota limite inferior de paginacion
			if ((this.state.actualPage - 1) <= 0) {
				return false
			}
			// no sobrepasar las sinos maximas
			let mns = this.state.minSino
			let min = ((mns - 5) >= 0 ) ? (mns - 5) : 0
			let max = this.state.maxSino - 5
			this.setState({
				minSino: min,
				maxSino: max,
				actualPage: this.state.actualPage - 1,
			})
		}
		nextPage(){
			// cota limite superior de pagina
			if ((this.state.actualPage + 1) > this.state.maxPage) {
				return false
			}
			// no sobrepasar las sinos maximas
			let mxs = this.state.maxSino
			// las sinodalias se cuentan desde cero

			// sll = sinodaliasListLength
			let sll = this.state.sinodaliasListLength
			// v1
			// let max = ((mxs + 5) <= sll) ? (mxs + 5) : sll
			// actual version
			let max = mxs + 5
			let min = this.state.minSino+5

			this.setState({
				minSino: min,
				maxSino: max,
				actualPage: this.state.actualPage + 1
			})
		}

	render() {
		return (
				<div>
					<div>
						<h2 className="text-center">Lista de Sinodalías creadas</h2>
						<br/>
					</div>
					<div className="row">
						<div className="col-md-5">
							<form action="">
							<div className="form-group">
							<label htmlFor="periodos-form">Selección de Periodo(solo disponibles)</label>
							<select id="periodos-form" name="periodos-form" className="form-control">
								{ this.state.ready ? this.state.periodosAct.map((periodo) => (
										<option key={ periodo.id } value={ periodo.id }>{ periodo.name }</option>
									)) : <option>No disponible</option> }
							</select>
							</div>
						</form>
						
							<div className="row">
								<div className="col-md-8">
								</div>
								<div className="col-md-2">
									<button className="btn btn-secondary"
											onClick={() => this.pullPeriodo()}>
											Filtrar periodo</button>
								</div>
							</div>
						</div>
						<div className="col-md-6">
							<form action="">
							<div className="form-group">
							<label htmlFor="periodos-form">Selección de profesores</label>
							<select id="teachers-form" name="periodos-form" className="form-control">
								{ this.state.ready ? this.state.teachers.map((teacher) => (
										(teacher.num_asignaciones > 0) && (
											<option key={ teacher.id } value={ teacher.id }>{ teacher.name }</option>
										)
									)) : <option>No disponible</option> }
							</select>
							</div>
						</form>
						
							<div className="row">
								<div className="col-md-8">
								</div>
								<div className="col-md-2">
									<button className="btn btn-secondary"
											onClick={() => this.pullTeachers()}>
											Filtrar por profesores</button>
								</div>
							</div>
						</div>
					</div>
					<br/>
					<table className="table">
						<thead className="thead-dark">
					    <tr>
					    	<th scope="col">#</th>
					      <th scope="col">Residente</th>
					      <th scope="col">Proyecto</th>
					      <th scope="col">Carrera</th>
					      <th scope="col">N.de Control</th>
					      <th scope="col">Presidente</th>
					      <th scope="col">Secretario</th>
					      <th scope="col">Vocal</th>
					      <th scope="col">Vocal Suplente</th>
					      <th scope="col">Aprobaciones</th>
					    </tr>
					  </thead>
					  <tbody>
					  	{ this.showTableContent() }
					  </tbody>
					</table>
					{ this.state.sinodalias.length == 0 &&
						<div style={{ width:800, fontSize:35, marginLeft:300 }}>
			  			<div className="alert alert-danger" role="alert" style={{ marginRight:15 }}>
					  		Aún no has agregado ninguna sinodalía
							</div>
			  		</div>
					}
					{ this.state.maxPage > 1 && 
						<div className="row justify-content-md-center">
							<button style={{ marginRight: 5 }} 
											className="btn"
											onClick={() => this.previousPage()}>
											Previo</button>
											<p style={{ display: 'inline', fontSize:24, margin:5 }}>
												{this.state.actualPage}/{this.state.maxPage}
											</p>
							<button className="btn" 
											onClick={() => this.nextPage()}
											>Siguiente</button>
						</div>
					}
					<br/><br/><br/><br/><br/>
				</div>
			)
	}
}

export default SinodaliasTable