import React, { Component } from 'react'

class CreateNewAssigment extends Component {
	constructor (props) {
		super(props)

	}
	render(){
		return(
				<div>
					<h2>Asignación de nueva Sinodalía</h2>
					<form>
						<div className="form-group">
							<label for="profesor">Asignado(disponibles)</label>
							<select className="form-control" id="profesor">
								<option value="1">Juan Guerra</option>
								<option value="2">Marcelo Bustamante</option>
								<option value="3">Patricio Cuevas</option>
							</select>
						</div>
						<div className="form-group">
						
						</div>
					</form>
				</div>
			)
	}
}

export default CreateNewAssigment