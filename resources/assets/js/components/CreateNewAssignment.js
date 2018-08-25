import React, { Component } from 'react'

class CreateNewAssigment extends Component {
	constructor (props) {
		super(props)

	}
	render(){
		return(
				<div className="card">
					<div className="card-header">
						<h2>Asignación de nueva Sinodalía</h2>
					</div>
					<div className="card-body">
						<form>
						<div className="form-group">
							<label for="residente">Nombre del residente</label>
							<input id="residente" type="text" className="form-control" required/>
						</div>
						<div className="form-group">
							<label for="carrera">Carrera</label>
							<input id="carrera" type="text" className="form-control" required/>
						</div>
						<div className="form-group">
							<label for="proyecto">Nombre del Proyecto</label>
							<input id="proyecto" type="text" className="form-control" required/>
						</div>
						<div className="form-group">
							<label for="presidente">Asignado Presidente(disponibles)</label>
							<select className="form-control" id="presidente">
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
							<label for="secretario">Asignado Secretario(disponibles)</label>
							<select className="form-control" id="secretario">
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
							<label for="vocal">Asignado Vocal(disponibles)</label>
							<select className="form-control" id="vocal">
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
							<label for="vocal-suplente">Asignado Vocal Suplente(disponibles)</label>
							<select className="form-control" id="vocal-suplente">
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<input type="submit" value="Creat sinodalía" className="form-control" />
					</form>
					</div>
				</div>
			)
	}
}

export default CreateNewAssigment