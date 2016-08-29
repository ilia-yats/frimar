<?php

namespace Frimar;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ContactController
{
    /**
     * @var ContainerInterface
     */
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function show_list(Request $request, Response $response, array $args)
    {
        /**
         * @var \PDOStatement $get_contacts_stmt
         */
        $get_contacts_stmt = $this->ci->get('db')->prepare("
            SELECT
              contacts.*,
              streets.name AS street,
              districts.name AS district
            FROM contacts
            JOIN streets ON contacts.street_id = streets.id
            JOIN districts ON streets.district_id = districts.id
        ");

        if($get_contacts_stmt->execute()) {
            $contacts = $get_contacts_stmt->fetchAll();
            $this->ci->get('view')->render(
                $response,
                'contact/index.twig',
                [
                    'contacts' => $contacts,
                ]
            );
        } else {
            throw new \Exception('Cannot retrieve list of contacts from database');
        }
    }

    public function delete(Request $request, Response $response, array $args)
    {
        if( ! isset($args['id'])) {
            throw new \Exception('Id of contact to delete was not set');
        }

        $stmt = $this->ci->get('db')->prepare("
            DELETE FROM contacts WHERE id = ?
        ");
        $stmt->bindValue(1, $args['id'], \PDO::PARAM_INT);
        if($stmt->execute()) {

        } else {

        }

        return $response->withStatus(302)->withHeader("Location", $this->ci->get('router')->pathFor('contact_list'));
    }

    public function create_new(Request $request, Response $response, array $args)
    {
        if($request->isPost()) {
            $data = $request->getParsedBody();

            if($this->load($data)) {

            }

            return $response->withStatus(302)->withHeader("Location", $this->ci->get('router')->pathFor('contact_list'));

        } else {

            $districts = [];
            $get_districts_stmt = $this->ci->get('db')->prepare("
                SELECT * FROM districts
            ");
            if($get_districts_stmt->execute()) {
                $districts = $get_districts_stmt->fetchAll();
            }

            $this->ci->get('view')->render(
                $response,
                'contact/form.twig',
                [
                    'districts' => $districts,
                ]
            );
        }
    }

    public function update(Request $request, Response $response, array $args)
    {
        if($request->isPost()) {
            $data = $request->getParsedBody();
            if($this->load($data, $args['id'])) {

            }

            return $response->withStatus(302)->withHeader("Location", $this->ci->get('router')->pathFor('contact_list'));

        } else {
            if( ! isset($args['id'])) {
                throw new \Exception('Id of contact to update was not set');
            }
            $contact = new Contact();

            $get_contact_stmt = $this->ci->get('db')->prepare("
                SELECT * FROM contacts WHERE id = ?
            ");
            $get_contact_stmt->bindValue(1, $args['id'], \PDO::PARAM_INT);
            if($get_contact_stmt->execute()) {
                $contact_data = $get_contact_stmt->fetch();
                $contact->feed_data($contact_data, $args['id']);
            }

            $districts = [];
            $get_districts_stmt = $this->ci->get('db')->prepare("
                SELECT * FROM districts
            ");
            if($get_districts_stmt->execute()) {
                $districts = $get_districts_stmt->fetchAll();
            }

            $this->ci->get('view')->render(
                $response,
                'contact/form.twig',
                [
                    'contact' => $contact,
                    'districts' => $districts,
                ]
            );
        }
    }

    public function load(array $data, $id = NULL)
    {
        $contact = new Contact();
        $contact->feed_data($data, $id);
        $values = array_values($contact->data);

        if( ! is_null($contact->id)) {
            $placeholders = implode(',', array_map(function($field) {
                return "$field = ?";
            }, array_keys($contact->data)));
            $stmt = $this->ci->get('db')->prepare("
                UPDATE contacts SET $placeholders WHERE id = ?
            ");
            $values[] = $contact->id;
            $result = $stmt->execute($values);

        } else {
            $fields_names = implode(',', array_keys($contact->data));
            $placeholders = implode(',', array_fill(0, count($contact->data), '?'));
            $stmt = $this->ci->get('db')->prepare("
                INSERT INTO contacts($fields_names) VALUES ($placeholders)
            ");
            $result = $stmt->execute($values);
        }

        return $result;
    }
}