<?php
/**
*@package pXP
*@file gen-Tratamiento.php
*@author  (admin)
*@date 25-01-2017 22:44:44
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.Tratamiento=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.Tratamiento.superclass.constructor.call(this,config);
		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})
	},
	
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_tratamiento'
			},
			type:'Field',
			form:true 
		},
		{
			config:{
				name: 'estado_reg',
				fieldLabel: 'Estado Reg.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:10
			},
				type:'TextField',
				filters:{pfiltro:'tra.estado_reg',type:'string'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'nombre',
				fieldLabel: 'Nombre',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:500
			},
				type:'TextField',
				filters:{pfiltro:'tra.nombre',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'descripcion',
				fieldLabel: 'Descripcion',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:500
			},
				type:'TextArea',
				filters:{pfiltro:'tra.descripcion',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
        {
                    config: {
                        //enviar erreglo
                        name: 'id_insumos',
                        fieldLabel: 'Insumos',
                        allowBlank: true,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_medicina_natural/control/Insumo/listarInsumo',
                            id: 'id_insumo',
                            root: 'datos',
                            sortInfo: {
                                field: 'nombre',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_insumo', 'nombre','codigo'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'ins.nombre'}
                        }),
                        valueField: 'id_insumo',
                        displayField: 'nombre',
                        gdisplayField: 'nombre',
                        hiddenName: 'id_insumo',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 5,
                        queryDelay: 1000,
                        anchor: '80%',
                        gwidth: 150,
                        minChars: 2,
                        //para multiples
                        enableMultiSelect: true,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['insumos']);
                        }
                    },
                    //cambair el tipo de combo
                    type: 'AwesomeCombo',
                    id_grupo: 0,
                    filters: {pfiltro: 'ins.nombre', type: 'string'},
                    grid: false,
                    form: true
        },
		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'tra.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'tra.usuario_ai',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_reg',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu1.cuenta',type:'string'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'id_usuario_ai',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'tra.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'usr_mod',
				fieldLabel: 'Modificado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu2.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_mod',
				fieldLabel: 'Fecha Modif.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'tra.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,	
	title:'Tratamiento',
	ActSave:'../../sis_medicina_natural/control/Tratamiento/insertarTratamiento',
	ActDel:'../../sis_medicina_natural/control/Tratamiento/eliminarTratamiento',
	ActList:'../../sis_medicina_natural/control/Tratamiento/listarTratamiento',
	id_store:'id_tratamiento',
	fields: [
		{name:'id_tratamiento', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'descripcion', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usuario_ai', type: 'string'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
        {name:'id_insumos', type: 'string'},
		{name:'insumos', type: 'string'},
		{name:'nombre', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_tratamiento',
		direction: 'ASC'
	},
	bdel:true,
	bsave:true,
	east: {
                url: '../../../sis_medicina_natural/vista/tratamiento_insumo/TratamientoInsumo.php',
                title: 'Insumos asignados',
                width: '50%',
                cls: 'TratamientoInsumo',
                collapsed: false
    }
    
	}
)
</script>
		
		