# (C) 2009 Kim Bruning.
#
# Distributed under the terms of the MIT license.

import settings_handler as settings
import os, os.path, shutil
import subprocess
from tags import Tags

try:
	# this won't work if we haven't installed the extension_tester and pywikipedia
	import wiki_works
except:
	pass # we'll deal with this later (in __init__).
		# this allows us to import the module, even
		#though the class can't work (yet)


class Test_Exception(Exception):
	pass

class Test_System(object):
	"""An Abstract(?) Test System."""
	system_name=None
	destination_dir=None

	def __init__(self,target=None):
		if "wiki_works" not in globals():
			raise Test_Exception("You need to install pywikipedia and the extension-tester before you can run tests. You can find these fine tools under toolkit:")
		self.testfiles=settings.testfiles
		self.destination_dir=None
		self.target=target
		self.as_alias=None
		self.revision=None
		self.tag=None

	def get_entities(self):
		"""list the extensions we have tests for"""
		entities=os.listdir(self.testfiles)
		entities=[]
		for line in entities:
			if line.endswith(".test"):
				entities2.append(line.replace(".test",""))

		entities2.sort()
		return entities2

	def tests_for_entity(self, entity):
		# TODO we only have one kind of test right right now.
		return ["exttest"]

	def entity_exists(self,entity_name):
		"""checks to see if a particular installer exists"""
		return entity_name in self.get_entities()

	def test_exists(self, entity, test):
		if self.entity_exists(entity):
			return test in self.tests_for_extension(extension)
		else:
			 return false

	def testdir_name(self, entity_name):
		"""returns the location of the .install directory for the given installer_name.
		An installer directory is where we store all the scripts to install one particular
		extension, tool from the toolkit, or etc. """
		return os.path.join(self.testfiles, entity_name+".tests")

	
	def test (self, entity, test, target=None):
		if not target:
			target=self.target
		if not target:
			raise Test_Exception("What mediawiki instance would you like to test?")
		if test=="exttest":
			self.run_exttest(entity)
		elif test=="wikiworks":
			self.run_wikiworks()
		else:
			raise Test_Exception("I don't know of a test called '"+str(test)+"'.")

	def run_exttest(self,target,entity):
		"""XXX TODO """
		pass
	
	def run_wikiworks(self,target):
		return wiki_works.wiki_works(target)
