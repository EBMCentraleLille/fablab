<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/5/16
 * Time: 5:22 PM
 */

namespace CentraleLille\CustomFosUserBundle\Entity;

interface ProjectableUserInterface
{

    /**
     * Gets the user's projects.
     *
     * @return \Traversable
     */
    public function getProjectUsers();

    /**
     * Gets the name of the projects which include the user.
     *
     * @return array
     */
    public function getProjectNames();


    /**
     * Indicates whether the user belongs to the specified project or not.
     *
     * @param string $name Name of the project
     *
     * @return Boolean
     */
    public function hasProject($name);

//    /**
//     * Add a project to the user projects.
//     *
//     * @param Project $project
//     *
//     * @return self
//     */
//    public function addProject($project);
//
//    /**
//     * Remove a project from the user projects.
//     *
//     * @param Project $project
//     *
//     * @return self
//     */
//    public function removeProject($project);
}
