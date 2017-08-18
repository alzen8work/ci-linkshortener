module.exports = function(grunt){
	
	// var vendorPath			= 'vendor/';
	// var ciSourcePath			= vendorPath+'alzen8work/hmvc-mod/';
	// var rootPath				= '../../../root/';
	
	var rootPath				= '../../../';
	var vendorPath				= '';
	var ciSourcePath			= vendorPath+'';
	
	
	//### Configuration
	grunt.initConfig({
		//pass in options to plugins, references to files etc
		
		copy: {
			main: {
				files: [
				
					//ci path
					{expand: true, cwd:ciSourcePath+'',src: ['.htaccess'], dest: rootPath+''},
					{expand: true, cwd:ciSourcePath+'',src: ['index.php'], dest: rootPath+''},
					{expand: true, cwd:ciSourcePath+'',src: ['package.json'], dest: rootPath+''},
					
					{expand: true, cwd:ciSourcePath+'__build/',src: ['**'], dest: rootPath+'__build/'},
					{expand: true, cwd:ciSourcePath+'__build/',src: ['.*'], dest: rootPath+'__build/'},
					{expand: true, cwd:ciSourcePath+'vendor/',src: ['**'], dest: rootPath+'vendor/'},
					{expand: true, cwd:ciSourcePath+'vendor/',src: ['.*'], dest: rootPath+'vendor/'},
					{expand: true, cwd:ciSourcePath+'content/',src: ['**'], dest: rootPath+'content/'},
					{expand: true, cwd:ciSourcePath+'content/',src: ['.*'], dest: rootPath+'content/'},
					{expand: true, cwd:ciSourcePath+'__modules/',src: ['**'], dest: rootPath+'__modules/'},
					{expand: true, cwd:ciSourcePath+'__modules/',src: ['.*'], dest: rootPath+'__modules/'},
					{expand: true, cwd:ciSourcePath+'_app/',src: ['**'], dest: rootPath+'_app/'},
					{expand: true, cwd:ciSourcePath+'_app/',src: ['.*'], dest: rootPath+'_app/'},
					{expand: true, cwd:ciSourcePath+'_sys/',src: ['**'], dest: rootPath+'_sys/'},
					{expand: true, cwd:ciSourcePath+'_sys/',src: ['.*'], dest: rootPath+'_sys/'},
					{expand: true, cwd:ciSourcePath+'node_modules/',src: ['**'], dest: rootPath+'node_modules/'},
					{expand: true, cwd:ciSourcePath+'node_modules/',src: ['.*'], dest: rootPath+'node_modules/'},
					
				],
			},
		},
	});

	//### Load plugins
	// grunt.loadNpmTasks('grunt-contrib-concat');
	// grunt.loadNpmTasks('grunt-sass');
	// grunt.loadNpmTasks('grunt-contrib-uglify');
	// grunt.loadNpmTasks('grunt-contrib-cssmin');
	// grunt.loadNpmTasks('grunt-contrib-watch');
	// grunt.loadNpmTasks('grunt-stripcomments');
	grunt.loadNpmTasks('grunt-contrib-copy');
	// grunt.loadNpmTasks('grunt-contrib-clean');


	//### Register task
	grunt.registerTask('all-copy', ['copy']);

};